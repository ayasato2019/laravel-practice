<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // ブログポストの一覧を取得
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    // 新しいポストを作成
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);

        $post = Post::create($validatedData);
        return response()->json($post, 201);
    }

    // 特定のポストを更新
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validatedData);
        return response()->json($post);
    }

    // 特定のポストを削除
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(null, 204);
    }
}
