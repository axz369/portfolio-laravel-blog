<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        // タグ一覧を取得する処理を実装する

        $tags = Tag::all();

        return view('tags.index', ['tags' => $tags]);
    }

    public function create()
    {
        return view('tags.create');
    }


    public function store(Request $request)
    {
        // タグ作成の処理を実装する

        $request->validate([
            'name' => 'required|unique:tags|max:30',
        ]);

        $tag = auth()->user()->tags()->create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'タグが作成されました');
    }
}
