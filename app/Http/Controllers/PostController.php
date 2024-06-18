<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $posts = $query->orderBy('status', 'desc')->orderBy('created_at', 'desc')->get();
        $ongoingCount = Post::where('status', 1)->count();
        $completedCount = Post::where('status', 0)->count();

        return view('posts.index', compact('posts', 'ongoingCount', 'completedCount'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);

        $posts = Post::create([
            'title' => $request->title,
            'status' => $request->status
        ]);

        return redirect()->route('posts.index')->with('success', 'posts berhasil ditambahkan');
    }

    public function show()
    {
    }

    public function edit(string $id)
    {
        $posts = Post::findOrFail($id);
        return view('posts.edit', [
            'posts' => $posts,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);

        $posts = Post::findOrFail($id);

        $posts->title = $request->title;
        $posts->status = $request->status;
        $posts->save();


        return redirect()->route('posts.index')->with('success', 'posts berhasil diperbarui');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post has been soft deleted.');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('posts.trash')->with('success', 'Post has been restored.');
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('posts.trash')->with('success', 'Post has been permanently deleted.');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->get();
        $ongoing = Post::where('status', 1)->onlyTrashed()->count();
        $completed = Post::where('status', 0)->onlyTrashed()->count();
        return view('posts.trash', compact('posts', 'ongoing', 'completed'));
    }

    public function filter($status)
    {
        $posts = Post::where('status', $status)->orderBy('created_at', 'desc')->get();
        $ongoingCount = Post::where('status', 1)->count();
        $completedCount = Post::where('status', 0)->count();

        return view('posts.index', compact('posts', 'ongoingCount', 'completedCount'));
    }

    public function filterTrash($status)
    {
        $posts = Post::where('status', $status)->orderBy('created_at', 'desc')->get();
        $ongoing = Post::where('status', 1)->onlyTrashed()->count();
        $completed = Post::where('status', 0)->onlyTrashed()->count();

        return view('posts.trash', compact('posts', 'ongoing', 'completed'));
    }
}
