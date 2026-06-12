<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.pages.about')
            ->layout('layouts.app', [
                'title' => 'About Us - Build Syntax',
                'description' => 'Learn about Build Syntax, our mission, our values, and how we approach your next web development project.'
            ]);
    }
}