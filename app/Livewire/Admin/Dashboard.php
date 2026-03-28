<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use App\Models\Project;
use App\Models\Category;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Contact;

#[Layout('layouts.admin')]
class Dashboard extends AdminComponent
{
    public $projects = [];
    public $categories = [];
    public $services = [];
    public $teamMembers = [];
    public $testimonials = [];
    public $contacts = [];
    public $loading = true;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->projects = Project::all()->toArray();
        $this->categories = Category::all()->toArray();
        $this->services = Service::all()->toArray();
        $this->teamMembers = TeamMember::all()->toArray();
        $this->testimonials = Testimonial::all()->toArray();
        $this->contacts = Contact::all()->toArray();
        $this->loading = false;
    }

    public function render()
    {
        $publishedProjects = count(array_filter($this->projects, fn($p) => $p['status'] === 'published'));
        $featuredProjects = count(array_filter($this->projects, fn($p) => $p['featured']));
        $newContacts = count(array_filter($this->contacts, fn($c) => $c['status'] === 'new'));

        return view('livewire.admin.dashboard', [
            'publishedProjects' => $publishedProjects,
            'featuredProjects' => $featuredProjects,
            'newContacts' => $newContacts,
        ]);
    }
}
