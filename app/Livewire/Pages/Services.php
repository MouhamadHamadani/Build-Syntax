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
                'description' => 'Transparent pricing for custom web development, ShopNex e-commerce, CarteNex digital menus, Tymelo booking and LebaSouk POS point of sale.'
            ]);
    }
}