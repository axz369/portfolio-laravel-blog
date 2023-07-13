<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Image; // 追加

class PostController extends Controller
{
    public function create(){
        return view('post.create');
    }

    public function store(Request $request){

        $validated=$request->validate([
            'title'=>'required|max:20',
            'body'=>'required|max:1000',
            'images.*' => 'image|max:2048', // バリデーション追加
        ]);

        $validated['user_id']=auth()->id();

        $post=Post::create($validated);

        $request->session()->flash('message','投稿しました');
        return back();
    }

    public function index(){
        $posts=Post::where('user_id',auth()->id())->get();
        return view('post.index',compact('posts'));
    }

    public function show (Post $post){
        return view('post.show',compact('post'));
    }

    public function edit(Post $post){
        $images = $post->images;
        return view('post.edit',compact('post', 'images'));
    }


    public function update(Request $request, Post $post){

        $validated=$request->validate([
            'title'=>'required|max:20',
            'body'=>'required|max:1000',
        ]);

        $validated['user_id']=auth()->id();

        $post->update($validated);

        $request->session()->flash('message','更新しました');
        return back();
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('post.index');
    }
}
