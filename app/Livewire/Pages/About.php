<?php

namespace App\Livewire\Pages;

use App\Support\Catalog;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.pages.about', ['products' => app(Catalog::class)->products()])
            ->layout('layouts.app', [
                'title' => 'About Us - Build Syntax',
                'description' => 'Build Syntax is a Beirut studio that builds websites, online stores, digital menus, booking systems and a point of sale for businesses in Lebanon and the region.',
            ]);
    }
}
