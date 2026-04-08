<?php

namespace App\Livewire\Admin\Services;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Service;
use Illuminate\Support\Str;

#[Layout('layouts.admin')]
class ServicesIndex extends AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 12;

    public $allServices = [];

    public $loading = true;

    public $showModal = false;

    public $editingService = null;

    public $title = '';

    public $description = '';

    public $icon = 'bi-lightbulb';

    public $featured = false;

    public $displayOrder = 0;

    public $status = 'published';

    public $showDeleteModal = false;

    public $deleteId = null;

    public $iconOptions = [
        ['value' => 'bi-lightbulb', 'label' => 'Light Bulb'],
        ['value' => 'bi-code-slash', 'label' => 'Code'],
        ['value' => 'bi-phone', 'label' => 'Phone'],
        ['value' => 'bi-palette', 'label' => 'Palette'],
        ['value' => 'bi-cart', 'label' => 'Cart'],
        ['value' => 'bi-cloud', 'label' => 'Cloud'],
        ['value' => 'bi-megaphone', 'label' => 'Megaphone'],
        ['value' => 'bi-graph-up-arrow', 'label' => 'Analytics'],
        ['value' => 'bi-shield-check', 'label' => 'Security'],
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->allServices = Service::orderBy('display_order')->get()->toArray();
        $this->loading = false;
    }

    public function openModal($service = null)
    {
        if ($service) {
            $this->editingService = $service;
            $this->title = $service['title'];
            $this->description = $service['description'] ?? '';
            $this->icon = $service['icon'] ?? 'bi-lightbulb';
            $this->featured = $service['featured'] ?? false;
            $this->displayOrder = $service['display_order'] ?? 0;
            $this->status = $service['status'] ?? 'published';
        } else {
            $this->resetForm();
            $this->displayOrder = count($this->allServices) + 1;
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingService = null;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->icon = 'bi-lightbulb';
        $this->featured = false;
        $this->displayOrder = 0;
        $this->status = 'published';
    }

    public function save()
    {
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'icon' => $this->icon,
            'featured' => $this->featured,
            'display_order' => $this->displayOrder,
            'status' => $this->status,
        ];

        if ($this->editingService) {
            Service::where('id', $this->editingService['id'])->update($data);
            $this->dispatch('toast', ['message' => 'Service updated successfully!', 'type' => 'success']);
        } else {
            $data['id'] = (string) Str::uuid();
            Service::create($data);
            $this->dispatch('toast', ['message' => 'Service created successfully!', 'type' => 'success']);
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
            Service::where('id', $this->deleteId)->delete();
            $this->dispatch('toast', ['message' => 'Service deleted successfully!', 'type' => 'success']);
        }
        $this->cancelDelete();
        $this->loadData();
    }

    public function render()
    {
        $services = Service::orderBy('display_order', 'asc')->paginate($this->perPage);
        return view('livewire.admin.services.services-index', [
            'services' => $services
        ]);
    }
}
