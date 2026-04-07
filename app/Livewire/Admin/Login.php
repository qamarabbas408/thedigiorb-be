<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Login extends Component
{
    public $password = '';
    public $error = '';

    protected $rules = [
        'password' => 'required|string',
    ];

    public function mount()
    {
        if (session()->get('admin_authenticated')) {
            redirect('/admin');
        }
    }

    public function login()
    {
        $this->validate();
        
        $adminPassword = config('app.admin_password', 'admin123');
        
        if ($this->password === $adminPassword) {
            session()->put('admin_authenticated', true);
            redirect('/admin');
            return;
        }
        
        $this->error = 'Invalid password. Please try again.';
        $this->password = '';
    }

    #[Layout('layouts.admin-login')]
    public function render()
    {
        return view('livewire.admin.login');
    }
}
