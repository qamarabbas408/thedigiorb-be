<?php

namespace App\Livewire\Admin;

use Livewire\Component;

abstract class AdminComponent extends Component
{
    public $sidebarOpen = true;

    protected $navItems = [
        ['href' => '/admin', 'label' => 'Dashboard', 'icon' => 'bi-grid-1x2-fill', 'color' => 'from-blue-500 to-cyan-500'],
        ['href' => '/admin/projects', 'label' => 'Projects', 'icon' => 'bi-briefcase-fill', 'color' => 'from-violet-500 to-purple-500'],
        ['href' => '/admin/categories', 'label' => 'Categories', 'icon' => 'bi-tags-fill', 'color' => 'from-pink-500 to-rose-500'],
        ['href' => '/admin/services', 'label' => 'Services', 'icon' => 'bi-gear-fill', 'color' => 'from-amber-500 to-orange-500'],
        ['href' => '/admin/stats', 'label' => 'Stats', 'icon' => 'bi-bar-chart-fill', 'color' => 'from-emerald-500 to-teal-500'],
        ['href' => '/admin/team', 'label' => 'Team', 'icon' => 'bi-people-fill', 'color' => 'from-indigo-500 to-blue-500'],
        ['href' => '/admin/testimonials', 'label' => 'Testimonials', 'icon' => 'bi-chat-quote-fill', 'color' => 'from-cyan-500 to-sky-500'],
        ['href' => '/admin/contacts', 'label' => 'Contacts', 'icon' => 'bi-envelope-fill', 'color' => 'from-red-500 to-pink-500'],
        ['href' => '/admin/settings', 'label' => 'Settings', 'icon' => 'bi-sliders', 'color' => 'from-slate-500 to-gray-500'],
    ];

    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect('/admin/login');
    }

    public function toggleSidebar()
    {
        $this->sidebarOpen = !$this->sidebarOpen;
    }
}
