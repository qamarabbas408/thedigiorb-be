<?php

namespace App\Livewire\Admin\Team;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use App\Models\TeamMember;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class TeamIndex extends AdminComponent
{
    use WithFileUploads;
    
    public $members = [];
    public $loading = true;
    public $showModal = false;
    public $editingMember = null;
    public $name = '';
    public $role = '';
    public $bio = '';
    public $image = '';
    public $imageUrl = '';
    public $imageTab = 'upload'; // 'upload' or 'url'
    public $mainImageFile = null;
    public $facebook_url = '#';
    public $twitter_url = '#';
    public $linkedin_url = '#';
    public $instagram_url = '#';
    public $displayOrder = 0;
    public $status = 'active';
    public $showDeleteModal = false;
    public $deleteId = null;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->members = TeamMember::orderBy('display_order')->get()->toArray();
        $this->loading = false;
    }

    public function openModal($member = null)
    {
        if ($member) {
            $this->editingMember = $member;
            $this->name = $member['name'];
            $this->role = $member['role'] ?? '';
            $this->bio = $member['bio'] ?? '';
            $this->image = $member['image'] ?? '';
            $this->imageUrl = '';
            $this->imageTab = 'upload'; // Default to upload tab
            $this->facebook_url = $member['facebook_url'] ?? '#';
            $this->twitter_url = $member['twitter_url'] ?? '#';
            $this->linkedin_url = $member['linkedin_url'] ?? '#';
            $this->instagram_url = $member['instagram_url'] ?? '#';
            $this->displayOrder = $member['display_order'] ?? 0;
            $this->status = $member['status'] ?? 'active';
        } else {
            $this->resetModal();
            $this->displayOrder = count($this->members) + 1;
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingMember = null;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->role = '';
        $this->bio = '';
        $this->image = '';
        $this->imageUrl = '';
        $this->imageTab = 'upload';
        $this->mainImageFile = null;
        $this->facebook_url = '#';
        $this->twitter_url = '#';
        $this->linkedin_url = '#';
        $this->instagram_url = '#';
        $this->displayOrder = 0;
        $this->status = 'active';
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'imageUrl' => 'nullable|url',
            'mainImageFile' => 'nullable|image|max:10240',
        ]);

        // Validate that either main image file or image URL is provided
        if (!$this->mainImageFile && !$this->imageUrl && !$this->image) {
            $this->addError('imageRequired', 'A profile image is required. Please either upload an image or provide an image URL.');
            return;
        }

        // Process main image
        if ($this->mainImageFile) {
            try {
                $uploadService = app(\App\Services\FileUploadService::class);
                $uploadedImage = $uploadService->uploadImage($this->mainImageFile, 'team/members');
                $this->image = $uploadedImage['url'];
                $this->dispatch('toast', ['message' => 'Profile image uploaded successfully!', 'type' => 'success']);
            } catch (\Exception $e) {
                $this->addError('mainImageFile', 'Failed to upload profile image: ' . $e->getMessage());
                $this->dispatch('toast', ['message' => 'Failed to upload profile image', 'type' => 'error']);
            }
        } elseif ($this->imageUrl) {
            // Use the provided URL
            $this->image = $this->imageUrl;
        }

        $data = [
            'name' => $this->name,
            'role' => $this->role,
            'bio' => $this->bio,
            'image' => $this->image,
            'facebook_url' => $this->facebook_url,
            'twitter_url' => $this->twitter_url,
            'linkedin_url' => $this->linkedin_url,
            'instagram_url' => $this->instagram_url,
            'display_order' => $this->displayOrder,
            'status' => $this->status,
        ];

        if ($this->editingMember) {
            TeamMember::where('id', $this->editingMember['id'])->update($data);
            $this->dispatch('toast', ['message' => 'Team member updated successfully!', 'type' => 'success']);
        } else {
            TeamMember::create($data);
            $this->dispatch('toast', ['message' => 'Team member created successfully!', 'type' => 'success']);
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
            TeamMember::where('id', $this->deleteId)->delete();
            $this->dispatch('toast', ['message' => 'Team member deleted successfully!', 'type' => 'success']);
        }
        $this->cancelDelete();
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.admin.team.team-index');
    }
}
