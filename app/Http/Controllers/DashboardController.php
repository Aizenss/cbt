<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function viewAdminGuru()
    {
        return view('dashboard');
    }

    public function viewUser()
    {
        return view('dashboard');
    }
}
