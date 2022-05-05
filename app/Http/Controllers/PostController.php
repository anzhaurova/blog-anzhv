<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;  //добавляем оператор use чтобы использовать Laravel Helper для создания слагов


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all Posts, ordered by the newest first
        $posts = Post::latest()->get();

        // Pass Post Collection to view
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show create post form
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //проверяем отправленные данные с формы
        $validated = $request->validate([
            'title' => 'required|string|unique:posts|min:5|max:100',
            'content' => 'required|string|min:5|max:2000',
        ]);

        // Create slug from title  Создаем слаг из заголовка
        $validated['slug'] = Str::slug($validated['title'], '-');

        // Create and save post with validated data Создаем и сохраняем пост с проверенными данными
        $post = Post::create($validated);

        // Redirect the user to the created post with a success notification Перенаправляем пользователя на созданный пост с уведомлением об успешном завершении
        return redirect(route('posts.show', [$post->slug]))->with('notification', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // Pass current post to view  Передаем текущий пост для просмотра
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Validate posted form data
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:100',
            'content' => 'required|string|min:5|max:2000',
        ]);

        // Create slug from title
        $validated['slug'] = Str::slug($validated['title'], '-');

        // Update Post with validated data
        $post->update($validated);

        // Redirect the user to the created post woth an updated notification
        return redirect(route('posts.index', [$post->slug]))->with('notification', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Delete the specified Post
        $post->delete();

        // Redirect user with a deleted notification
        return redirect(route('posts.index'))->with('notification', '"' . $post->title .  '" deleted!');
    }
}
