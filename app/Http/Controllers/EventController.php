<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController
{
    public function index()
    {
        $events = Event::orderBy('start_date', 'desc')->paginate(10);
        return view('events.index', compact('events'));
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

        if ($request->start_date > $request->end_date) {
            return redirect()->route('events.create')->withErrors([
                'start_date' => 'A data de início deve ser anterior à data de término',
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
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        /**  @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            return redirect()->route('dashboard')->withErrors([
                'error' => 'Somente administradores podem editar eventos',
            ]);
        }

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        /**  @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            return redirect()->route('dashboard')->withErrors([
                'error' => 'Somente administradores podem atualizar eventos',
            ]);
        }

        if ($request->start_date > $request->end_date) {
            return redirect()->route('events.create')->withErrors([
                'start_date' => 'A data de início deve ser anterior à data de término',
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

        $old_image_path = $event->image_path;
        $event->update($request->all());

        if ($image && $old_image_path) {
            $old_image_full_path = public_path($old_image_path);

            if (file_exists($old_image_full_path)) {
                unlink($old_image_full_path);
            }
        }

        return redirect()->route('dashboard')->withSuccess('Evento atualizado com sucesso');
    }

    public function delete(Event $event)
    {
        /**  @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            return redirect()->route('dashboard')->withErrors([
                'edit_news' => 'Você não tem permissão para editar este evento',
            ]);
        }

        return view('events.delete', compact('event'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        /**  @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin()) {
            return redirect()->route('dashboard')->withErrors([
                'edit_news' => 'Você não tem permissão para editar este evento',
            ]);
        }

        $image_path = $event->image_path;
        $event->delete();

        // Remove the event image
        if ($image_path) {
            $image_full_path = public_path($image_path);

            if (file_exists($image_full_path)) {
                unlink($image_full_path);
            }
        }

        return redirect()->route('dashboard')->withSuccess('Evento excluído com sucesso');
    }
}
