<?php

namespace App\Livewire\Pages;

use App\Models\PortfolioProject;
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
        return view('livewire.pages.home')
            ->layout('layouts.app', [
                'title' => 'Home - Build Syntax',
                'description' => 'Build Syntax is a Beirut-based development partner dedicated to transforming your ideas into powerful, modern, and reliable websites and applications.'
            ]);
    }
}