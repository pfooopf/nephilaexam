<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch tasks for the logged-in user
        $tasks = Auth::user()->tasks;
        // dd($tasks);
        return view('dashboard', compact('tasks'));
    }
}
