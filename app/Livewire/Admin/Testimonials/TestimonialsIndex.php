<?php

namespace App\Livewire\Admin\Testimonials;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use App\Models\Testimonial;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class TestimonialsIndex extends AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 12;

    public $allTestimonials = [];

    public $loading = true;
    public $showModal = false;
    public $editingId = null;
    public $name = '';
    public $title = '';
    public $company = '';
    public $content = '';
    public $rating = 5;
    public $image = '';
    public $featured = false;
    public $status = 'published';
    public $showDeleteModal = false;
    public $deleteId = null;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->allTestimonials = Testimonial::orderBy('created_at', 'desc')->get()->toArray();
        $this->loading = false;
    }

    public function openModal($testimonial = null)
    {
        if ($testimonial) {
            $this->editingId = $testimonial['id'];
            $this->name = $testimonial['name'];
            $this->title = $testimonial['title'] ?? '';
            $this->company = $testimonial['company'] ?? '';
            $this->content = $testimonial['content'];
            $this->rating = $testimonial['rating'] ?? 5;
            $this->image = $testimonial['image'] ?? '';
            $this->featured = $testimonial['featured'] ?? false;
            $this->status = $testimonial['status'] ?? 'published';
        } else {
            $this->resetForm();
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingId = null;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->title = '';
        $this->company = '';
        $this->content = '';
        $this->rating = 5;
        $this->image = '';
        $this->featured = false;
        $this->status = 'published';
    }

    public function save()
    {
        $data = [
            'name' => $this->name,
            'title' => $this->title,
            'company' => $this->company,
            'content' => $this->content,
            'rating' => $this->rating,
            'image' => $this->image,
            'featured' => $this->featured,
            'status' => $this->status,
        ];

        if ($this->editingId) {
            Testimonial::where('id', $this->editingId)->update($data);
            $this->dispatch('toast', ['message' => 'Testimonial updated successfully!', 'type' => 'success']);
        } else {
            Testimonial::create($data);
            $this->dispatch('toast', ['message' => 'Testimonial created successfully!', 'type' => 'success']);
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
            Testimonial::where('id', $this->deleteId)->delete();
            $this->dispatch('toast', ['message' => 'Testimonial deleted successfully!', 'type' => 'success']);
        }
        $this->showDeleteModal = false;
        $this->deleteId = null;
        $this->loadData();
    }

    public function render()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.admin.testimonials.testimonials-index', [
            'testimonials' => $testimonials
        ]);
    }
}
