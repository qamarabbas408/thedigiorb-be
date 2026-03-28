<?php

namespace App\Livewire\Admin\Projects;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;

#[Layout('layouts.admin')]
class ProjectsIndex extends AdminComponent
{
    public $projects = [];
    public $categories = [];
    public $loading = true;
    
    public $showModal = false;
    public $editingProject = null;
    
    public $title = '';
    public $subtitle = '';
    public $categoryId = '';
    public $year = '';
    public $technologies = '';
    public $description = '';
    public $image = '';
    public $gallery = [];
    public $client = '';
    public $url = '';
    public $featured = false;
    public $status = 'published';
    
    public $deleteId = null;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->projects = Project::orderBy('created_at', 'desc')->get()->toArray();
        $this->categories = Category::orderBy('name')->get()->toArray();
        $this->loading = false;
    }

    public function openModal($project = null)
    {
        if ($project) {
            $this->editingProject = $project;
            $this->title = $project['title'];
            $this->subtitle = $project['subtitle'] ?? '';
            $this->categoryId = $project['category_id'];
            $this->year = $project['year'] ?? '';
            $this->technologies = is_array($project['technologies']) ? implode(', ', $project['technologies']) : '';
            $this->description = $project['description'] ?? '';
            $this->image = $project['image'] ?? '';
            $this->gallery = is_array($project['gallery']) ? $project['gallery'] : [];
            $this->client = $project['client'] ?? '';
            $this->url = $project['url'] ?? '';
            $this->featured = $project['featured'] ?? false;
            $this->status = $project['status'] ?? 'published';
        } else {
            $this->resetForm();
            $this->categoryId = $this->categories[0]['id'] ?? '';
            $this->year = date('Y');
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingProject = null;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->title = '';
        $this->subtitle = '';
        $this->categoryId = '';
        $this->year = date('Y');
        $this->technologies = '';
        $this->description = '';
        $this->image = '';
        $this->gallery = [];
        $this->client = '';
        $this->url = '';
        $this->featured = false;
        $this->status = 'published';
    }

    public function save()
    {
        $techArray = array_map('trim', explode(',', $this->technologies));
        $techArray = array_filter($techArray);

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'category_id' => $this->categoryId,
            'year' => $this->year,
            'technologies' => array_values($techArray),
            'description' => $this->description,
            'image' => $this->image,
            'gallery' => $this->gallery,
            'client' => $this->client,
            'url' => $this->url,
            'featured' => $this->featured,
            'status' => $this->status,
        ];

        if ($this->editingProject) {
            Project::where('id', $this->editingProject['id'])->update($data);
            $this->dispatch('toast', ['message' => 'Project updated successfully!', 'type' => 'success']);
        } else {
            Project::create($data);
            $this->dispatch('toast', ['message' => 'Project created successfully!', 'type' => 'success']);
        }

        $this->closeModal();
        $this->loadData();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function delete()
    {
        if ($this->deleteId) {
            Project::where('id', $this->deleteId)->delete();
            $this->dispatch('toast', ['message' => 'Project deleted successfully!', 'type' => 'success']);
        }
        $this->cancelDelete();
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.admin.projects.projects-index');
    }
}
