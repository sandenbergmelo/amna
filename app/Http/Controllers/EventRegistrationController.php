<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRegistrationRequest;
use App\Models\User;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        $user = Auth::user();
        return view('event-registration.register', compact('user', 'event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRegistrationRequest $request)
    {
        /** @var User */
        $user = Auth::user();

        $user->eventRegistrations()->attach($request->event_id, [
            'registration_date' => $request->registration_date,
            'status_presence' => $request->status_presence,
        ]);

        return redirect()->route('dashboard')->with('success', 'Você foi registrado com sucesso no evento!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validação dos dados recebidos
        $request->validate([
            'status_presence' => 'required|string|in:Confirmed,Pending',
        ]);

        /** @var EventRegistration */
        $eventRegistration = EventRegistration::find($id);

        $eventRegistration->update([
            'status_presence' => $request->status_presence,
        ]);

        return redirect()->route('dashboard')->with('success', 'Presença atualizada com sucesso!');
    }
}
