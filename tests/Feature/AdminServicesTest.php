<?php

namespace Tests\Feature;

use App\Livewire\Admin\Services\Index;
use App\Models\CatalogPlan;
use App\Models\CatalogService;
use App\Models\ContactSubmission;
use App\Models\User;
use App\Support\CatalogSource\DatabaseCatalogRepository;
use Database\Seeders\CatalogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Activitylog\Models\Activity;
use Tests\TestCase;

class AdminServicesTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CatalogSeeder::class);
        config(['catalog.source' => 'database']);
        DatabaseCatalogRepository::flush();
        $this->admin = User::factory()->admin()->create(['name' => 'Mouhamad Hamadani']);
        $this->actingAs($this->admin);
    }

    private function editor(string $service = 'tymelo')
    {
        return Livewire::test(Index::class, ['service' => $service]);
    }

    private function plan(string $service, string $name): CatalogPlan
    {
        return CatalogService::where('slug', $service)->firstOrFail()->plans()->where('name', $name)->firstOrFail();
    }

    // --- Access and the screen -----------------------------------------------------------------

    public function test_the_screen_lists_products_and_services_with_plan_counts_and_loads_the_service_from_the_url(): void
    {
        $this->get('/admin/services?service=tymelo')->assertOk()
            ->assertSee('Services and pricing')
            ->assertSeeInOrder(['Products', 'CarteNex', 'ShopNex', 'Tymelo', 'LebaSouk POS', 'Services', 'Custom development', 'Hosting', 'Maintenance'])
            ->assertDontSee('Editing plan:')
            ->assertSee('Business');
    }

    public function test_an_unknown_service_in_the_url_falls_back_to_the_first_one(): void
    {
        $this->editor('nope')->assertSet('service', 'cartenex');
    }

    // --- Prices --------------------------------------------------------------------------------

    public function test_editing_a_plan_price_goes_live_on_the_site_and_is_logged_with_who_and_when(): void
    {
        $business = $this->plan('tymelo', 'Business');

        $this->get('/services')->assertSee('$749');

        $this->editor()->call('editPlan', $business->id)->set('plan.price', '$799')->call('savePlan')->assertHasNoErrors();

        $this->assertSame('$799', $business->fresh()->price);

        $this->get('/services')->assertSee('$799')->assertDontSee('$749');
        $this->get('/')->assertSee('$799');
        $this->get('/services')->assertSee(e(route('contact', ['type' => 'appointment', 'plan' => 'Business'])), false);

        $log = Activity::where('subject_type', CatalogPlan::class)->where('subject_id', $business->id)->latest('id')->first();
        $this->assertNotNull($log);
        $this->assertSame($this->admin->id, $log->causer_id);
        $this->assertSame('$749', $log->properties['old']['price']);
        $this->assertSame('$799', $log->properties['attributes']['price']);
    }

    public function test_seeding_itself_writes_no_activity_log(): void
    {
        $this->assertSame(0, Activity::count());
    }

    public function test_features_can_be_added_removed_and_moved_and_a_blank_row_is_dropped(): void
    {
        $starter = $this->plan('tymelo', 'Starter');

        $this->editor()->call('editPlan', $starter->id)
            ->call('addFeature')->set('plan.features.4', 'Extra feature')
            ->call('moveFeature', 4, -1)
            ->call('removeFeature', 0)
            ->call('addFeature')
            ->call('savePlan')->assertHasNoErrors();

        $this->assertSame(
            ['Guest booking', 'Email confirmations and reminders', 'Extra feature', 'WhatsApp buttons'],
            $starter->fresh()->features->pluck('text')->all(),
        );
        $this->get('/services')->assertSeeInOrder(['Extra feature', 'WhatsApp buttons']);
    }

    public function test_plans_can_be_moved_up_and_down_and_the_site_follows(): void
    {
        $this->editor('cartenex')->call('movePlan', $this->plan('cartenex', 'Pro')->id, -1);

        $this->assertSame(['Pro', 'Basic', 'Premium'], CatalogService::where('slug', 'cartenex')->first()->plans->pluck('name')->all());
        $this->assertSame(['Pro', 'Basic', 'Premium'], array_column(app(\App\Support\Catalog::class)->product('cartenex')['plans'], 'name'));

        // The first plan cannot move further up.
        $this->editor('cartenex')->call('movePlan', $this->plan('cartenex', 'Pro')->id, -1);
        $this->assertSame(['Pro', 'Basic', 'Premium'], CatalogService::where('slug', 'cartenex')->first()->plans->pluck('name')->all());
    }

    public function test_a_plan_can_be_added_and_deleted(): void
    {
        $this->editor()->call('addPlan')
            ->set('plan.name', 'Studio')->set('plan.price', 'From $1,200')->set('plan.summary', 'Big places.')->set('plan.features.0', 'Everything')
            ->call('savePlan')->assertHasNoErrors();

        $studio = $this->plan('tymelo', 'Studio');
        $this->assertSame(3, $studio->sort_order);
        $this->get('/services')->assertSee('Studio')->assertSee('From $1,200');

        $this->editor()->call('deletePlan', $studio->id);
        $this->assertDatabaseMissing('catalog_plans', ['id' => $studio->id]);
        $this->assertDatabaseMissing('catalog_plan_features', ['plan_id' => $studio->id]);
    }

    // --- Validation ----------------------------------------------------------------------------

    public function test_plan_validation_limits(): void
    {
        $starter = $this->plan('tymelo', 'Starter');
        $page = $this->editor()->call('editPlan', $starter->id);

        $page->set('plan.name', str_repeat('a', 81))->call('savePlan')->assertHasErrors(['plan.name' => 'max']);
        $page->set('plan.name', '')->call('savePlan')->assertHasErrors(['plan.name' => 'required']);
        $page->set('plan.name', 'Starter')->set('plan.price', str_repeat('9', 41))->call('savePlan')->assertHasErrors(['plan.price' => 'max']);
        $page->set('plan.price', '')->call('savePlan')->assertHasErrors(['plan.price' => 'required']);
        $page->set('plan.price', '$1')->set('plan.summary', str_repeat('s', 1001))->call('savePlan')->assertHasErrors(['plan.summary' => 'max']);
        $page->set('plan.summary', 'ok')->set('plan.features', [str_repeat('f', 201)])->call('savePlan')->assertHasErrors(['plan.features.0' => 'max']);
        $page->set('plan.features', array_map(fn ($i) => "Feature $i", range(1, 13)))->call('savePlan')->assertHasErrors(['plan.features' => 'max']);

        $this->assertSame('$349', $starter->fresh()->price);
    }

    public function test_a_service_can_have_at_most_six_plans(): void
    {
        $page = $this->editor('maintenance'); // seeded with four

        foreach (['Five', 'Six'] as $name) {
            $page->call('addPlan')->set('plan.name', $name)->set('plan.price', '$1')->call('savePlan')->assertHasNoErrors();
        }

        $this->assertSame(6, CatalogService::where('slug', 'maintenance')->first()->plans()->count());

        $page->call('closePlan')->call('addPlan')->assertSet('planOpen', false)->assertSet('noticeType', 'error');
    }

    public function test_service_validation_accent_slug_and_urls(): void
    {
        $page = $this->editor();

        $page->set('form.accent', '#1D9E75')->call('saveService')->assertHasErrors(['form.accent']);
        $page->set('form.accent', 'tymelo')->set('form.slug', 'Bad Slug!')->call('saveService')->assertHasErrors(['form.slug']);
        $page->set('form.slug', 'cartenex')->call('saveService')->assertHasErrors(['form.slug' => 'unique']);
        $page->set('form.slug', 'tymelo')->set('form.demo_url', 'javascript:alert(1)')->call('saveService')->assertHasErrors(['form.demo_url']);
        $page->set('form.demo_url', 'ftp://example.com')->call('saveService')->assertHasErrors(['form.demo_url']);
        $page->set('form.demo_url', 'https://tymelo.build-syntax.com/book-guest')->set('form.name', str_repeat('n', 81))->call('saveService')->assertHasErrors(['form.name' => 'max']);
        $page->set('form.name', 'Tymelo')->set('form.description', str_repeat('d', 1001))->call('saveService')->assertHasErrors(['form.description' => 'max']);
        $page->set('form.description', 'ok')->set('form.features', str_repeat('x', 201))->call('saveService')->assertHasErrors(['form.features']);

        $this->assertSame('Tymelo', CatalogService::where('slug', 'tymelo')->first()->name);
    }

    public function test_everything_the_editor_saves_is_escaped_on_the_public_pages(): void
    {
        $starter = $this->plan('tymelo', 'Starter');
        $this->editor()->call('editPlan', $starter->id)
            ->set('plan.summary', '<script>alert("x")</script>')->set('plan.features.0', '<img src=x onerror=alert(1)>')->call('savePlan')->assertHasNoErrors();

        $html = $this->get('/services')->assertOk()->getContent();
        $this->assertStringNotContainsString('<script>alert("x")</script>', $html);
        $this->assertStringNotContainsString('<img src=x', $html);
        $this->assertStringContainsString('&lt;script&gt;alert(&quot;x&quot;)&lt;/script&gt;', $html);
    }

    // --- Services ------------------------------------------------------------------------------

    public function test_saving_a_service_updates_the_site_and_the_activity_log(): void
    {
        $this->editor()->set('form.headline_price', 'From $399')->set('form.description', 'New words.')->call('saveService')->assertHasNoErrors()
            ->assertDispatched('saved');

        $this->get('/')->assertSee('New words.');
        $this->assertTrue(Activity::where('subject_type', CatalogService::class)->where('causer_id', $this->admin->id)->exists());
    }

    public function test_the_visibility_switch_hides_a_product_everywhere_and_keeps_its_data(): void
    {
        $this->editor('tymelo')->set('form.is_visible', false)->call('saveService')->assertHasNoErrors();

        $this->get('/')->assertDontSee('Try the booking page');
        $this->get('/services')->assertDontSee('Try the booking page')->assertDontSee('id="tymelo"', false);
        $this->get('/portfolio')->assertDontSee('tymelo.build-syntax.com');
        $this->assertSame(2, CatalogService::where('slug', 'tymelo')->first()->plans()->count());

        $this->editor('tymelo')->assertSee('Hidden');
    }

    public function test_adding_a_service_creates_a_hidden_one_with_a_unique_slug_and_its_own_contact_type(): void
    {
        $page = $this->editor()->call('startAdding')->set('newName', 'Loyalty Cards')->call('addService')->assertHasNoErrors();

        $page->assertSet('service', 'loyalty-cards');
        $service = CatalogService::where('slug', 'loyalty-cards')->firstOrFail();
        $this->assertFalse($service->is_visible);
        $this->assertSame('product', $service->kind);
        $this->assertSame('loyalty_cards', $service->project_type);

        $this->editor()->call('startAdding')->set('newName', 'Loyalty Cards')->call('addService')->assertSet('service', 'loyalty-cards-2');
        $this->assertSame('loyalty_cards_2', CatalogService::where('slug', 'loyalty-cards-2')->value('project_type'));

        // A name that is also an existing contact type gets another one.
        $this->editor()->call('startAdding')->set('newName', 'POS')->call('addService');
        $this->assertNotSame('pos', CatalogService::where('slug', 'pos')->value('project_type'));

        $this->editor()->call('startAdding')->set('newName', '')->call('addService')->assertHasErrors(['newName' => 'required']);
        $this->editor()->call('startAdding')->set('newName', str_repeat('n', 81))->call('addService')->assertHasErrors(['newName' => 'max']);
    }

    public function test_a_service_that_is_the_only_one_for_its_contact_type_cannot_be_deleted_while_enquiries_exist(): void
    {
        ContactSubmission::create(['name' => 'Sara', 'email' => 's@example.com', 'project_type' => 'pos', 'message' => 'Need a till please.']);

        $this->editor('lebasouk')->call('deleteService')->assertSet('noticeType', 'error')->assertSee('Cannot delete');
        $this->assertDatabaseHas('catalog_services', ['slug' => 'lebasouk']);

        // Another service on the same type frees it.
        CatalogService::create(['slug' => 'pos-two', 'kind' => 'product', 'name' => 'POS Two', 'project_type' => 'pos', 'accent' => 'brand', 'is_visible' => false, 'sort_order' => 9]);
        $this->editor('lebasouk')->call('deleteService');
        $this->assertDatabaseMissing('catalog_services', ['slug' => 'lebasouk']);
        $this->assertDatabaseMissing('catalog_plans', ['name' => 'Premium', 'price' => 'Contact us']);
    }

    public function test_only_products_can_be_deleted(): void
    {
        $this->editor('hosting')->call('deleteService');

        $this->assertDatabaseHas('catalog_services', ['slug' => 'hosting']);
    }

    public function test_hosting_tiers_and_maintenance_plans_are_editable_and_keep_their_shape(): void
    {
        $small = $this->plan('hosting', 'Small sites');
        $this->editor('hosting')->call('editPlan', $small->id)->set('plan.price', '$220')->call('savePlan')->assertHasNoErrors();

        $this->assertSame('$220', app(\App\Support\Catalog::class)->hosting()['tiers'][0]['price']);
        $this->assertSame(['name', 'price', 'period', 'features'], array_keys(app(\App\Support\Catalog::class)->hosting()['tiers'][0]));
        $this->get('/services')->assertSee('$220');

        $essential = $this->plan('maintenance', 'Essential');
        $this->editor('maintenance')->call('editPlan', $essential->id)->set('plan.price', '$85')->call('savePlan')->assertHasNoErrors();
        $this->assertSame('$85', app(\App\Support\Catalog::class)->maintenance()['plans'][0]['price']);
        $this->assertSame('Maintenance-Essential', app(\App\Support\Catalog::class)->maintenance()['plans'][0]['plan_key']);
    }

    public function test_a_text_only_price_and_a_from_price_keep_their_shape(): void
    {
        $premium = $this->plan('lebasouk', 'Premium'); // "Contact us"
        $this->editor('lebasouk')->call('editPlan', $premium->id)->set('plan.price', 'Ask us')->call('savePlan')->assertHasNoErrors();
        $plan = app(\App\Support\Catalog::class)->product('lebasouk')['plans'][2];
        $this->assertNull($plan['price']);
        $this->assertSame('Ask us', $plan['unit']);

        $starter = $this->plan('custom', 'Starter');
        $this->editor('custom')->call('editPlan', $starter->id)->set('plan.price', 'From $900')->call('savePlan')->assertHasNoErrors();
        $plan = app(\App\Support\Catalog::class)->custom()['service']['plans'][0];
        $this->assertSame('From ', $plan['prefix']);
        $this->assertSame('$900', $plan['price']);
    }
}
