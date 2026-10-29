<?php

namespace App\Livewire\Pages;

use App\Models\PortfolioProject;
use App\Support\Catalog;
use Livewire\Component;

class Home extends Component
{
    public $featuredProjects;

    public function mount()
    {
        // Load 3 featured projects for homepage
        $this->featuredProjects = PortfolioProject::featured()
            ->take(3)
            ->get();
    }

    public function render()
    {
        $catalog = app(Catalog::class);

        return view('livewire.pages.home', [
            'products' => $catalog->products(),
            'custom' => $catalog->custom(),
        ])->layout('layouts.app', [
            'title' => 'Home - Build Syntax',
            'description' => 'Build Syntax is a Beirut web studio. CarteNex menus, ShopNex stores, Tymelo bookings and LebaSouk POS, plus custom development, with prices up front.',
        ]);
    }
}
