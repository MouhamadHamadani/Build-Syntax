<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.pages.privacy-policy')
            ->layout('layouts.app', [
                'title' => 'Privacy Policy - Build Syntax',
                'description' => 'Read the Build Syntax privacy policy. Learn how we collect, use, and protect your information.',
            ]);
    }
}
