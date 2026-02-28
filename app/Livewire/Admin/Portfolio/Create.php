<?php

namespace App\Livewire\Admin\Portfolio;

use App\Models\PortfolioProject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public string $title        = '';
    public string $description  = '';
    public string $category     = '';
    public string $technologies = ''; // comma-separated
    public string $project_url  = '';
    public string $image_url    = '';
    public bool   $featured     = false;

    protected $rules = [
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'category'    => 'required|in:web,ecommerce,mobile,other',
        'technologies'=> 'nullable|string',
        'project_url' => 'nullable|url',
        'image_url'   => 'nullable|url',
        'featured'    => 'boolean',
    ];

    public function save(): void
    {
        $this->validate();

        $techs = array_filter(array_map('trim', explode(',', $this->technologies)));

        PortfolioProject::create([
            'title'        => $this->title,
            'description'  => $this->description,
            'category'     => $this->category,
            'technologies' => !empty($techs) ? $techs : null,
            'project_url'  => $this->project_url ?: null,
            'image_url'    => $this->image_url ?: null,
            'featured'     => $this->featured,
            'created_by'   => Auth::id(),
        ]);

        session()->flash('success', 'Project created successfully.');
        $this->redirect(route('admin.portfolio.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.portfolio.create')
            ->layout('layouts.admin', ['title' => 'New Project']);
    }
}