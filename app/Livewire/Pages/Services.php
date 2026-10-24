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
                'description' => 'Explore our services with transparent pricing: ShopNex e-commerce platforms, CarteNex digital menus, Tymelo appointment booking, LebaSouk POS point of sale (one-time license), and custom websites.'
            ]);
    }
}