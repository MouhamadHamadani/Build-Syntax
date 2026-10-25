<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        return view('livewire.pages.services', [
            'products' => config('catalog.products'),
            'custom' => config('catalog.custom'),
            'hosting' => config('catalog.hosting'),
        ])->layout('layouts.app', [
            'title' => 'Services and pricing | Build Syntax',
            'description' => 'Prices for CarteNex digital menus, ShopNex online stores, Tymelo booking, LebaSouk POS, custom websites, hosting and maintenance.',
        ]);
    }
}
