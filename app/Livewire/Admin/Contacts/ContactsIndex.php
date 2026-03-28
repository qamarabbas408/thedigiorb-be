<?php

namespace App\Livewire\Admin\Contacts;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use App\Models\Contact;

#[Layout('layouts.admin')]
class ContactsIndex extends AdminComponent
{
    public $contacts = [];
    public $loading = true;
    public $filter = 'all';
    public $selectedContact = null;
    public $showDeleteModal = false;
    public $deleteId = null;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $query = Contact::orderBy('created_at', 'desc');
        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }
        $this->contacts = $query->get()->toArray();
        $this->loading = false;
    }

    public function updatedFilter()
    {
        $this->loadData();
    }

    public function selectContact($contact)
    {
        $this->selectedContact = $contact;
        if ($contact['status'] === 'new') {
            Contact::where('id', $contact['id'])->update(['status' => 'read']);
            $this->loadData();
        }
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->deleteId) {
            Contact::where('id', $this->deleteId)->delete();
            $this->dispatch('toast', ['message' => 'Contact deleted successfully!', 'type' => 'success']);
            if ($this->selectedContact && $this->selectedContact['id'] === $this->deleteId) {
                $this->selectedContact = null;
            }
        }
        $this->showDeleteModal = false;
        $this->deleteId = null;
        $this->loadData();
    }

    public function render()
    {
        $newCount = Contact::where('status', 'new')->count();
        
        return view('livewire.admin.contacts.contacts-index', [
            'newCount' => $newCount,
        ]);
    }
}
