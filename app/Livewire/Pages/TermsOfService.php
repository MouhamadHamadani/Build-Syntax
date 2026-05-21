<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class TermsOfService extends Component
{
    public function render()
    {
        return view('livewire.pages.terms-of-service')
            ->layout('layouts.app', [
                'title' => 'Terms of Service - Build Syntax',
                'description' => 'Read the Build Syntax terms of service. Understand our project terms, payment, IP, and warranty policies.',
            ]);
    }
}
