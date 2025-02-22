<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController
{
    public function index()
    {
        return view('dashboard');
    }
}
