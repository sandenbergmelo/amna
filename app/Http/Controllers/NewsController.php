<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController
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
                'create_news' => 'Somente administradores podem criar notícias',
            ]);
        }

        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
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
                . str_replace(' ', '-', $original_name)
                . '.'
                . $image->extension();

            $image->storeAs('news_images', $image_file_name, 'public');
            $image_path = 'storage/news_images/' . $image_file_name;

            $request['image_path'] = $image_path;
        }

        $request['user_id'] = $user->id;

        News::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Notícia criada com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
