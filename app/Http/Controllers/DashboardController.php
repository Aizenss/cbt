<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('user.dashboard');
    }
    public function indexAdmin()
    {
        return view('dashboard');
    }

    public function create()
    {
        //
    }
    public function show()
    {
        return view('user.detail');
    }
}
