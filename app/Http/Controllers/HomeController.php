<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $events = Event::orderBy('start_date', 'desc')->paginate(3);
        $news = News::orderBy('created_at', 'desc')->paginate(3);

        return view('home', compact('events', 'news'));
    }

    public function about()
    {
        return view('about');
    }
}
