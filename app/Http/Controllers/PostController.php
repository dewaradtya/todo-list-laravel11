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
        $this->middleware('user-access');
    }

    public function index(Request $request)
    {
        $query = Post::where('user_id', Auth::id());

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $posts = $query->orderBy('status', 'desc')->orderBy('created_at', 'desc')->get();
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

        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan');
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $posts = Post::where('user_id', Auth::id())->findOrFail($id);

        return view('posts.edit', compact('posts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);

        $post = Post::where('user_id', Auth::id())->findOrFail($id);

        $post->title = $request->title;
        $post->status = $request->status;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui');
    }

    public function destroy($id)
    {
        $post = Post::where('user_id', Auth::id())->findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus');
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->where('user_id', Auth::id())->findOrFail($id);
        $post->restore();

        return redirect()->route('posts.trash')->with('success', 'Post berhasil dipulihkan');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->where('user_id', Auth::id())->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('posts.trash')->with('success', 'Post berhasil dihapus secara permanen');
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
        $posts = Post::where('status', $status)->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $ongoingCount = Post::where('status', 1)->where('user_id', Auth::id())->count();
        $completedCount = Post::where('status', 0)->where('user_id', Auth::id())->count();

        return view('posts.index', compact('posts', 'ongoingCount', 'completedCount'));
    }

    public function filterTrash($status)
    {
        $posts = Post::where('status', $status)->onlyTrashed()->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $ongoing = Post::where('status', 1)->onlyTrashed()->where('user_id', Auth::id())->count();
        $completed = Post::where('status', 0)->onlyTrashed()->where('user_id', Auth::id())->count();

        return view('posts.trash', compact('posts', 'ongoing', 'completed'));
    }
}
