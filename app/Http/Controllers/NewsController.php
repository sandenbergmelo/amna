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
                . str_replace(' ', '-', $original_name);

            $image->storeAs('news_images', $image_file_name, 'public');
            $image_path = 'storage/news_images/' . $image_file_name;

            $request['image_path'] = $image_path;
        }

        $request['user_id'] = $user->id;

        News::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Notícia criada com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        /**  @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin() || $user->id !== $news->user_id) {
            return redirect()->route('dashboard')->withErrors([
                'create_news' => 'Você não tem permissão para editar esta notícia',
            ]);
        }

        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, News $news)
    {
        /**  @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin() || $user->id !== $news->user_id) {
            return redirect()->route('dashboard')->withErrors([
                'edit_news' => 'Você não tem permissão para editar esta notícia',
            ]);
        }

        $image = $request->file('image');

        if ($image) {
            $original_name = $image->getClientOriginalName();

            $image_file_name = date('YmdHisu')
                . '-'
                . str_replace(' ', '-', $original_name);

            $image->storeAs('news_images', $image_file_name, 'public');
            $image_path = 'storage/news_images/' . $image_file_name;

            $request['image_path'] = $image_path;
        }

        $old_image_path = $news->image_path;
        $news->update($request->all());

        if ($image && $old_image_path) {
            $old_image_full_path = public_path($old_image_path);

            if (file_exists($old_image_full_path)) {
                unlink($old_image_full_path);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Notícia atualizada com sucesso');
    }

    public function delete(News $news)
    {
        /**  @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin() || $user->id !== $news->user_id) {
            return redirect()->route('dashboard')->withErrors([
                'edit_news' => 'Você não tem permissão para deletar esta notícia',
            ]);
        }

        return view('news.delete', compact('news'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        /**  @var User $user */
        $user = Auth::user();

        if (!$user->isAdmin() || $user->id !== $news->user_id) {
            return redirect()->route('dashboard')->withErrors([
                'edit_news' => 'Você não tem permissão para editar esta notícia',
            ]);
        }

        $image_path = $news->image_path;
        $news->delete();

        // Remove the news image
        if ($image_path) {
            $image_full_path = public_path($image_path);
            if (file_exists($image_full_path)) {
                unlink($image_full_path);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Notícia excluída com sucesso');
    }
}
