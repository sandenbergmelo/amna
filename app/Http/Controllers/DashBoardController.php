<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoardController
{
    public function index()
    {
        $user = Auth::user();
        $events = Event::all();

        return view('dashboard', compact('user', 'events'));
    }
}
