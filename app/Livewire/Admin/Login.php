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

    public function login()
    {
        $this->validate();
        
        $adminPassword = config('app.admin_password', 'admin123');
        
        if ($this->password === $adminPassword) {
            session()->put('admin_authenticated', true);
            return redirect('/admin');
        }
        
        $this->error = 'Invalid password. Please try again.';
        $this->password = '';
    }

    #[Layout('layouts.admin-login')]
    public function render()
    {
        if (session()->get('admin_authenticated')) {
            return $this->redirect('/admin');
        }
        
        return view('livewire.admin.login');
    }
}
