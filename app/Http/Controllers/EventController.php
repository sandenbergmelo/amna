<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /**  @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            return redirect()->route('dashboard')->withErrors([
                'create_news' => 'Somente administradores podem criar eventos',
            ]);
        }

        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        /**  @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            return redirect()->route('dashboard')->withErrors([
                'error' => 'Somente administradores podem criar notícias',
            ]);
        }

        $image = $request->file('image');
        if ($image) {
            $original_name = $image->getClientOriginalName();

            $image_file_name = date('YmdHisu')
                . '-'
                . str_replace(' ', '-', $original_name);

            $image->storeAs('event_images', $image_file_name, 'public');
            $image_path = 'storage/event_images/' . $image_file_name;

            $request['image_path'] = $image_path;
        }

        Event::create($request->all());

        return redirect()->route('dashboard')->withSuccess('Evento criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
