<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        return view('user/dashboard');
    }

    public function admin()
    {
        return view('admin/dashboard');
    }
}
