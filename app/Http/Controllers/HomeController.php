<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Article::with([
                'user' => function($q){
                    $q->select('id', 'name');
                },
            ])
            ->orderBy('created_at', 'DESC')
            ->select('id', 'title', 'text', 'created_at', 'user_id')
            ->get();
        return view('home', compact('articles'));
    }
}
