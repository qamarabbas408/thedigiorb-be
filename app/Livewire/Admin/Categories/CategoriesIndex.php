<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use App\Models\Category;
use Illuminate\Support\Str;

#[Layout('layouts.admin')]
class CategoriesIndex extends AdminComponent
{
    public $categories = [];
    public $loading = true;
    
    public $showModal = false;
    public $editingCategory = null;
    
    public $name = '';
    public $icon = 'bi-folder';
    public $filterClass = '';
    
    public $showDeleteModal = false;
    public $deleteId = null;

    public $iconOptions = [
        'bi-globe', 'bi-phone', 'bi-palette', 'bi-ui-checks',
        'bi-laptop', 'bi-tablet', 'bi-code-slash', 'bi-pie-chart',
        'bi-cart', 'bi-building', 'bi-briefcase', 'bi-camera'
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->categories = Category::orderBy('name')->get()->toArray();
        $this->loading = false;
    }

    public function openModal($category = null)
    {
        if ($category) {
            $this->editingCategory = $category;
            $this->name = $category['name'];
            $this->icon = $category['icon'] ?? 'bi-folder';
            $this->filterClass = $category['filter_class'] ?? '';
        } else {
            $this->resetForm();
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingCategory = null;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->icon = 'bi-folder';
        $this->filterClass = '';
    }

    public function save()
    {
        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'icon' => $this->icon,
            'filter_class' => $this->filterClass ?: Str::slug($this->name),
        ];

        if ($this->editingCategory) {
            Category::where('id', $this->editingCategory['id'])->update($data);
            $this->dispatch('toast', ['message' => 'Category updated successfully!', 'type' => 'success']);
        } else {
            Category::create($data);
            $this->dispatch('toast', ['message' => 'Category created successfully!', 'type' => 'success']);
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
            Category::where('id', $this->deleteId)->delete();
            $this->dispatch('toast', ['message' => 'Category deleted successfully!', 'type' => 'success']);
        }
        $this->cancelDelete();
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.admin.categories.categories-index');
    }
}
