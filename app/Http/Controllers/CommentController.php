<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create(StoreCommentRequest $request, $id)
    {
        $article = Article::select('id', 'user_id')->find($id);
        if($article && $article->user_id != auth()->user()->id){
            $comment = Comment::create([
                'comment'       => $request->input('comment'),
                'article_id'    => $id,
                'user_id'       => auth()->user()->id,
            ]);
            return redirect()->back();
        }
        return redirect()->route('home');
    }
}
