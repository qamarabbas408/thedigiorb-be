<?php

namespace App\Livewire\Admin\GlobalStats;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use App\Models\GlobalStat;

#[Layout('layouts.admin')]
class GlobalStatsIndex extends AdminComponent
{
    public $stats = [];
    public $loading = true;
    public $showModal = false;
    public $editingStat = null;
    public $label = '';
    public $value = '';
    public $icon = 'bi-briefcase';
    public $displayOrder = 0;
    public $status = 'published';
    public $selectedSections = [];
    public $showDeleteModal = false;
    public $deleteId = null;

    public $iconOptions = [
        ['value' => 'bi-briefcase', 'label' => 'Briefcase'],
        ['value' => 'bi-heart', 'label' => 'Heart'],
        ['value' => 'bi-people', 'label' => 'People'],
        ['value' => 'bi-award', 'label' => 'Award'],
        ['value' => 'bi-check-circle', 'label' => 'Check Circle'],
        ['value' => 'bi-emoji-smile', 'label' => 'Smile'],
        ['value' => 'bi-calendar', 'label' => 'Calendar'],
        ['value' => 'bi-graph-up', 'label' => 'Graph Up'],
        ['value' => 'bi-megaphone', 'label' => 'Megaphone'],
        ['value' => 'bi-headset', 'label' => 'Headset'],
        ['value' => 'bi-folder', 'label' => 'Folder'],
        ['value' => 'bi-server', 'label' => 'Server'],
        ['value' => 'bi-star', 'label' => 'Star'],
        ['value' => 'bi-rocket-takeoff', 'label' => 'Rocket'],
        ['value' => 'bi-lightbulb', 'label' => 'Lightbulb'],
    ];

    public $sectionOptions = [
        ['value' => 'hero', 'label' => 'Hero'],
        ['value' => 'about', 'label' => 'About'],
        ['value' => 'services', 'label' => 'Services'],
        ['value' => 'why_us', 'label' => 'Why Us'],
        ['value' => 'team', 'label' => 'Team'],
        ['value' => 'contact', 'label' => 'Contact'],
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->stats = GlobalStat::orderBy('display_order')->get()->toArray();
        $this->loading = false;
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
            $this->selectedSections = $stat['sections'] ?? [];
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
        $this->selectedSections = [];
    }

    public function save()
    {
        $data = [
            'label' => $this->label,
            'value' => $this->value,
            'icon' => $this->icon,
            'display_order' => $this->displayOrder,
            'status' => $this->status,
            'sections' => $this->selectedSections,
        ];

        if ($this->editingStat) {
            GlobalStat::where('id', $this->editingStat['id'])->update($data);
            $this->dispatch('toast', ['message' => 'Global stat updated successfully!', 'type' => 'success']);
        } else {
            $key = \Illuminate\Support\Str::slug($this->label, '_');
            GlobalStat::create(array_merge($data, [
                'id' => (string) time() . '_' . rand(100, 999),
                'key' => $key,
            ]));
            $this->dispatch('toast', ['message' => 'Global stat created successfully!', 'type' => 'success']);
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
            GlobalStat::where('id', $this->deleteId)->delete();
            $this->dispatch('toast', ['message' => 'Global stat deleted successfully!', 'type' => 'success']);
        }
        $this->showDeleteModal = false;
        $this->deleteId = null;
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.admin.global-stats.global-stats-index');
    }
}
