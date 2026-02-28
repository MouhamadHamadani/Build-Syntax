<?php

namespace App\Livewire\Admin\Portfolio;

use App\Models\PortfolioProject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
    public PortfolioProject $portfolio;

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
        'category'    => 'required|string|max:100',
        'technologies'=> 'nullable|string',
        'project_url' => 'nullable|url',
        'image_url'   => 'nullable|url',
        'featured'    => 'boolean',
    ];

    public function mount(int $id): void
    {
        $this->portfolio = PortfolioProject::findOrFail($id);

        $this->title            = $this->portfolio->title;
        $this->description      = $this->portfolio->description;
        $this->category         = $this->portfolio->category;
        $this->technologies     = is_array($this->portfolio->technologies) ? implode(', ', $this->portfolio->technologies) : '';
        $this->project_url      = $this->portfolio->project_url;
        $this->image_url        = $this->portfolio->image_url;
        $this->featured         = $this->portfolio->featured;
    }

    public function save(): void
    {
        $this->validate();

        $techs = array_filter(array_map('trim', explode(',', $this->technologies)));

        $this->portfolio->update([
            'title'        => $this->title,
            'description'  => $this->description,
            'category'     => $this->category,
            'technologies' => !empty($techs) ? $techs : null,
            'project_url'  => $this->project_url ?: null,
            'image_url'    => $this->image_url ?: null,
            'featured'     => $this->featured,
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