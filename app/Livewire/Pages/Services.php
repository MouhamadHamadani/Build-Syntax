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
                'description' => 'Explore our services with transparent pricing: ShopNex e-commerce platforms, Tymelo appointment booking, POS Pro point of sale systems, and custom websites.'
            ]);
    }
}