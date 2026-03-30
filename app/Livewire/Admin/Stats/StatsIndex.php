<?php

namespace App\Livewire\Admin\Stats;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Reactive;
use App\Models\Stat;

#[Layout('layouts.admin')]
class StatsIndex extends AdminComponent
{
    public $stats = [];
    public $loading = true;
    public $selectedSection = 'hero';
    public $showModal = false;
    public $editingStat = null;
    public $label = '';
    public $value = '';
    public $icon = 'bi-briefcase';
    public $displayOrder = 0;
    public $status = 'published';
    public $showDeleteModal = false;
    public $deleteId = null;

    #[Reactive]
    public $sections = [
        ['value' => 'hero', 'label' => 'Hero Section'],
        ['value' => 'about', 'label' => 'About Section'],
        ['value' => 'services', 'label' => 'Services Section'],
        ['value' => 'why_us', 'label' => 'Why Us Section'],
        ['value' => 'contact', 'label' => 'Contact Section'],
    ];

    public $iconOptions = [
        ['value' => 'bi-briefcase', 'label' => 'Briefcase'],
        ['value' => 'bi-heart', 'label' => 'Heart'],
        ['value' => 'bi-people', 'label' => 'People'],
        ['value' => 'bi-award', 'label' => 'Award'],
        ['value' => 'bi-check-circle', 'label' => 'Check Circle'],
        ['value' => 'bi-emoji-smile', 'label' => 'Smile'],
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->stats = Stat::where('section', $this->selectedSection)->orderBy('display_order')->get()->toArray();
        $this->loading = false;
    }

    public function updatedSelectedSection()
    {
        $this->loadData();
    }

    public function openModal($stat = null)
    {
        if ($stat) {
            $this->editingStat = $stat;
            $this->label = $stat['label'];
            $this->value = $stat['value'];
            $this->icon = $stat['icon'] ?? 'bi-briefcase';
            $this->displayOrder = $stat['display_order'] ?? 0;
            $this->status = $stat['status'] ?? 'published';
        } else {
            $this->resetForm();
            $this->displayOrder = count($this->stats) + 1;
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingStat = null;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->label = '';
        $this->value = '';
        $this->icon = 'bi-briefcase';
        $this->displayOrder = 0;
        $this->status = 'published';
    }

    public function save()
    {
        $data = [
            'section' => $this->selectedSection,
            'label' => $this->label,
            'value' => $this->value,
            'icon' => $this->icon,
            'display_order' => $this->displayOrder,
            'status' => $this->status,
        ];

        if ($this->editingStat) {
            Stat::where('id', $this->editingStat['id'])->update($data);
            $this->dispatch('toast', ['message' => 'Stat updated successfully!', 'type' => 'success']);
        } else {
            $data['id'] = (string) time() . '_' . rand(100, 999);
            Stat::create($data);
            $this->dispatch('toast', ['message' => 'Stat created successfully!', 'type' => 'success']);
        }

        $this->closeModal();
        $this->loadData();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->deleteId) {
            Stat::where('id', $this->deleteId)->delete();
            $this->dispatch('toast', ['message' => 'Stat deleted successfully!', 'type' => 'success']);
        }
        $this->showDeleteModal = false;
        $this->deleteId = null;
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.admin.stats.stats-index');
    }
}
