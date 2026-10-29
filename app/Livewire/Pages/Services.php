<?php

namespace App\Livewire\Pages;

use App\Support\Catalog;
use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        $catalog = app(Catalog::class);

        return view('livewire.pages.services', [
            'products' => $catalog->products(),
            'custom' => $catalog->custom(),
            'hosting' => $catalog->hosting(),
            'maintenance' => $catalog->maintenance(),
        ])->layout('layouts.app', [
            'title' => 'Services and pricing | Build Syntax',
            'description' => 'Prices for CarteNex digital menus, ShopNex online stores, Tymelo booking, LebaSouk POS, custom websites, hosting and maintenance.',
        ]);
    }
}
