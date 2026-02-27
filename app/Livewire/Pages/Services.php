<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        return view('livewire.pages.services')
            ->layout('layouts.app', [
                'title' => 'Services & Pricing - Build Syntax',
                'description' => 'Explore our comprehensive web development services including E-Commerce systems, Appointment booking platforms, and custom web solutions with transparent pricing.'
            ]);
    }
}