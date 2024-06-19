<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('user-access')->only(['show', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $posts = $query->orderBy('status', 'desc')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $ongoingCount = Post::where('status', 1)->where('user_id', Auth::id())->count();
        $completedCount = Post::where('status', 0)->where('user_id', Auth::id())->count();

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

        $data = $request->all();
        $data['user_id'] = auth()->id();

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'posts berhasil ditambahkan');
    }

    public function show()
    {
        // 
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
        $posts = Post::onlyTrashed()->where('user_id', Auth::id())->get();
        $ongoing = Post::where('status', 1)->onlyTrashed()->where('user_id', Auth::id())->count();
        $completed = Post::where('status', 0)->onlyTrashed()->where('user_id', Auth::id())->count();
        return view('posts.trash', compact('posts', 'ongoing', 'completed'));
    }

    public function filter($status)
    {
        $posts = Post::where('status', $status)->orderBy('created_at', 'desc')->get();
        $ongoingCount = Post::where('status', 1)->where('user_id', Auth::id())->count();
        $completedCount = Post::where('status', 0)->where('user_id', Auth::id())->count();

        return view('posts.index', compact('posts', 'ongoingCount', 'completedCount'));
    }

    public function filterTrash($status)
    {
        $posts = Post::where('status', $status)->orderBy('created_at', 'desc')->get();
        $ongoing = Post::where('status', 1)->onlyTrashed()->where('user_id', Auth::id())->count();
        $completed = Post::where('status', 0)->onlyTrashed()->where('user_id', Auth::id())->count();

        return view('posts.trash', compact('posts', 'ongoing', 'completed'));
    }
}
