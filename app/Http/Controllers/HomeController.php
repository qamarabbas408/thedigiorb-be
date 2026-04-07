<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (session()->get('admin_authenticated')) {
            return redirect('/admin');
        }

        return redirect()->route('admin.login');
    }
}
