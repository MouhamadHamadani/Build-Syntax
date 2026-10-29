<?php

namespace Tests\Feature;

use App\Livewire\Admin\Contacts\Index as ContactsIndex;
use App\Livewire\Admin\Contacts\Show as ContactsShow;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Portfolio\Create as PortfolioCreate;
use App\Models\ContactSubmission;
use App\Models\PortfolioProject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private function contact(array $attributes = [], ?int $hoursAgo = null): ContactSubmission
    {
        $contact = ContactSubmission::create($attributes + [
            'name' => 'Layal Haddad',
            'email' => 'layal@example.com',
            'project_type' => 'cartenex',
            'message' => "I'm interested in the Pro plan. We have a café in Hamra.",
        ]);

        if ($hoursAgo !== null) {
            $contact->forceFill(['created_at' => now()->subHours($hoursAgo)])->save();
        }

        return $contact;
    }

    // --- Access -------------------------------------------------------------------------------

    public function test_guests_are_sent_to_the_login_page(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/login');
    }

    public function test_non_admins_get_403_on_every_admin_page(): void
    {
        $user = User::factory()->create();
        $contact = $this->contact();

        foreach (['dashboard', 'contacts', "contacts/{$contact->id}", 'blog', 'blog/create', 'portfolio', 'portfolio/create', 'newsletter', 'services'] as $path) {
            $this->actingAs($user)->get("/admin/{$path}")->assertForbidden();
        }
    }

    public function test_an_admin_logging_in_lands_on_the_dashboard(): void
    {
        $admin = User::factory()->admin()->create();

        $this->post('/login', ['email' => $admin->email, 'password' => 'password'])
            ->assertRedirect(route('admin.dashboard', absolute: false));

        $this->get('/admin/dashboard')->assertOk()->assertSee('Needs a reply');
    }

    public function test_every_admin_page_renders_for_an_admin_without_public_scripts(): void
    {
        $admin = User::factory()->admin()->create();
        $contact = $this->contact();
        $project = PortfolioProject::create(['title' => 'Olea', 'description' => 'Menu', 'category' => 'digital_menu']);

        foreach (['dashboard', 'contacts', "contacts/{$contact->id}", 'blog', 'blog/create', 'portfolio', 'portfolio/create', "portfolio/{$project->id}/edit", 'newsletter', 'services'] as $path) {
            $html = $this->actingAs($admin)->get("/admin/{$path}")->assertOk()->getContent();

            $this->assertStringNotContainsString('googletagmanager', $html, $path);
            $this->assertStringNotContainsString('Quick links', $html, $path);
            $this->assertStringContainsString('Services and pricing', $html, $path);
            $this->assertSame(1, substr_count($html, '<h1'), "{$path} must have exactly one h1");
        }

        $this->actingAs($admin)->get('/user/profile')->assertOk()->assertSee('My profile');
    }

    // --- Dashboard ----------------------------------------------------------------------------

    public function test_dashboard_lists_new_contacts_oldest_first_and_marks_overdue_ones(): void
    {
        $this->contact(['name' => 'Fresh Fiona'], 2);
        $this->contact(['name' => 'Waiting Walid'], 30);
        $this->contact(['name' => 'Done Dana', 'status' => 'completed'], 50);

        Livewire::actingAs(User::factory()->admin()->create())
            ->test(Dashboard::class)
            ->assertSeeInOrder(['Needs a reply', 'Waiting Walid', 'Overdue 24 h', 'Fresh Fiona'])
            ->assertDontSee('Done Dana')
            ->assertSee('Quick actions');
    }

    public function test_dashboard_counts_enquiries_per_product_in_one_grouped_set(): void
    {
        $this->contact(['project_type' => 'cartenex']);
        $this->contact(['project_type' => 'cartenex', 'email' => 'b@example.com']);
        $this->contact(['project_type' => 'ecommerce', 'email' => 'c@example.com']);

        $rows = Livewire::actingAs(User::factory()->admin()->create())
            ->test(Dashboard::class)
            ->assertSee('Enquiries by product')
            ->viewData('enquiriesByProduct');

        $this->assertSame(['CarteNex', 'ShopNex'], $rows->pluck('name')->all());
        $this->assertSame([2, 1], $rows->pluck('total')->all());
        $this->assertSame(['saffron', 'emerald'], $rows->pluck('accent')->all());
        $this->assertSame(100, $rows->first()['percent']);
    }

    public function test_dashboard_greets_the_admin_by_first_name(): void
    {
        Livewire::actingAs(User::factory()->admin()->create(['name' => 'Mouhamad Hamadani']))
            ->test(Dashboard::class)
            ->assertSeeHtml('Mouhamad</h1>');
    }

    // --- Contacts -----------------------------------------------------------------------------

    public function test_contacts_filter_by_product_status_and_search(): void
    {
        $this->contact(['name' => 'Layal Haddad', 'project_type' => 'cartenex', 'company' => 'Olea Cafe']);
        $this->contact(['name' => 'Karim Saade', 'email' => 'karim@example.com', 'project_type' => 'ecommerce', 'status' => 'contacted']);
        $this->contact(['name' => 'Hadi Fares', 'email' => 'hadi@example.com', 'project_type' => 'pos', 'priority' => 'high']);

        $page = Livewire::actingAs(User::factory()->admin()->create())->test(ContactsIndex::class);

        $page->assertSee('Layal Haddad')->assertSee('Karim Saade')->assertSee('Hadi Fares')
            ->assertSee('CarteNex · Pro');

        $page->set('product', 'ecommerce')->assertSee('Karim Saade')->assertDontSee('Layal Haddad')->assertDontSee('Hadi Fares');

        $page->set('product', '')->call('setStatus', 'contacted')->assertSee('Karim Saade')->assertDontSee('Hadi Fares');

        $page->call('setStatus', '')->set('priority', 'high')->assertSee('Hadi Fares')->assertDontSee('Layal Haddad');

        $page->set('priority', '')->set('search', 'olea')->assertSee('Layal Haddad')->assertDontSee('Karim Saade');
        $page->set('search', 'karim@example')->assertSee('Karim Saade')->assertDontSee('Layal Haddad');
    }

    public function test_contacts_status_tabs_show_counts_and_the_product_filter_uses_catalog_labels(): void
    {
        $this->contact();
        $this->contact(['email' => 'b@example.com', 'status' => 'declined']);

        Livewire::actingAs(User::factory()->admin()->create())
            ->test(ContactsIndex::class)
            ->assertSee('All · 2')
            ->assertSee('New · 1')
            ->assertSee('Declined · 1')
            ->assertSee('Contacted · 0')
            ->assertSee('CarteNex digital menu')
            ->assertSee('Custom website');
    }

    public function test_contact_detail_shows_whatsapp_only_when_there_is_a_phone(): void
    {
        $admin = User::factory()->admin()->create();
        $with = $this->contact(['phone' => '03 123 456']);
        $without = $this->contact(['email' => 'b@example.com', 'phone' => null]);
        $letters = $this->contact(['email' => 'c@example.com', 'phone' => 'call me']);

        Livewire::actingAs($admin)->test(ContactsShow::class, ['id' => $with->id])
            ->assertSee('Reply on WhatsApp')
            ->assertSeeHtml('href="https://wa.me/9613123456"')
            ->assertSeeHtml('href="mailto:layal@example.com"')
            ->assertSee('Reply by email')
            ->assertSee('CarteNex · Pro plan');

        Livewire::actingAs($admin)->test(ContactsShow::class, ['id' => $without->id])
            ->assertDontSee('Reply on WhatsApp')->assertSee('Reply by email');

        Livewire::actingAs($admin)->test(ContactsShow::class, ['id' => $letters->id])
            ->assertDontSee('Reply on WhatsApp');
    }

    public function test_contact_detail_saves_status_priority_and_notes_and_logs_them(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $contact = $this->contact();

        Livewire::test(ContactsShow::class, ['id' => $contact->id])
            ->set('status', 'in_progress')
            ->set('priority', 'urgent')
            ->set('notes', 'Call tomorrow')
            ->call('update')
            ->assertHasNoErrors()
            ->assertDispatched('saved');

        $this->assertDatabaseHas('contact_submissions', ['id' => $contact->id, 'status' => 'in_progress', 'priority' => 'urgent', 'notes' => 'Call tomorrow']);
        $this->assertDatabaseHas('activity_log', ['subject_type' => ContactSubmission::class, 'subject_id' => $contact->id]);
    }

    // --- Portfolio ----------------------------------------------------------------------------

    public function test_portfolio_form_offers_every_category_with_the_public_labels_and_accepts_each(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $page = Livewire::test(PortfolioCreate::class);

        foreach (['Custom development', 'CarteNex', 'ShopNex', 'Tymelo', 'LebaSouk POS', 'Other'] as $label) {
            $page->assertSee($label);
        }

        foreach (config('products.portfolio_categories') as $category) {
            Livewire::test(PortfolioCreate::class)
                ->set('title', "Project {$category}")
                ->set('description', 'A short description.')
                ->set('category', $category)
                ->call('save')
                ->assertHasNoErrors();

            $this->assertDatabaseHas('portfolio_projects', ['title' => "Project {$category}", 'category' => $category]);
        }
    }
}
