<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function create($postId)
    {
        $post = Post::find($postId);

        return view('comment.create', compact('post'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        $request->session()->flash('message', '投稿しました');
        return redirect()->route('otherPost.show', $request->post_id);
    }

    public function index(Post $post)
    {
        $comments = $post->comments;

        return view('comments.index', compact('post', 'comments'));
    }

    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('otherPost.show', $comment->post_id)->with('success', 'コメントが更新されました。');
    }

    public function destroy(Comment $comment){
        $comment->delete();
        return redirect()->route('otherPost.show',$comment->post_id);
    }
}
