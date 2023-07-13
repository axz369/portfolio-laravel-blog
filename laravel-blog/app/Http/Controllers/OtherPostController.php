<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class OtherPostController extends Controller
{
    public function index(){
        $posts=Post::where('user_id','!=',auth()->id())->get();
        return view('otherPost.index',compact('posts'));
    }

    public function show(Post $post){
        return view('otherPost.show',compact('post'));
    }
}
