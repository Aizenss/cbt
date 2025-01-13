<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserViewController extends Controller
{
    public function index()
    {
        return view('user.exam.index');
    }
    public function show()
    {
        return view('user.exam.complete');
    }
}
