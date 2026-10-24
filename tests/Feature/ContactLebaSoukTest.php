<?php

namespace Tests\Feature;

use App\Livewire\Pages\Contact;
use App\Notifications\NewContactSubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class ContactLebaSoukTest extends TestCase
{
    use RefreshDatabase;

    public function test_lebasouk_pos_enquiry_is_stored_and_notified(): void
    {
        Notification::fake();

        Livewire::test(Contact::class)
            ->set('name', 'Test Shopkeeper')
            ->set('email', 'shop@example.com')
            ->set('project_type', 'pos')
            ->set('message', 'I would like LebaSouk POS for my pharmacy.')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('contact_submissions', [
            'email' => 'shop@example.com',
            'project_type' => 'pos',
        ]);
        Notification::assertSentOnDemand(NewContactSubmission::class);
    }

    public function test_pos_cta_preselects_the_lebasouk_option(): void
    {
        Livewire::withQueryParams(['type' => 'pos'])
            ->test(Contact::class)
            ->assertSet('project_type', 'pos')
            ->assertSee('LebaSouk POS (Point of Sale)');
    }
}
