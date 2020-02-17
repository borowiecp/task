<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('user_id', auth()->user()->id)->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $imageName = $this->saveImage($request->file('img'));
        $article = Article::create([
            'title'     => $request->input('title'),
            'text'      => $request->input('text'),
            'img'       => $imageName,
            'user_id'   => auth()->user()->id,
        ]);

        return redirect()->route('articles.show', ['id' => $article->id]);
    }

    public function show($id)
    {
        $article = Article::with([
                'user' => function($q){
                    $q->select('id', 'name');
                },
                'comments' => function($q) {
                    $q->orderBy('created_at', 'ASC')->select('id', 'comment', 'user_id', 'article_id', 'created_at');
                },
                'comments.user' => function($q){
                    $q->select('id', 'name');
                },
            ])->find($id);
        if($article){
            return view('articles.show', compact('article'));
        }
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $article = Article::find($id);
        if($article && $article->user_id == auth()->user()->id){
            return view('articles.edit', compact('article'));
        }
        return redirect()->route('home');
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::find($id);
        if($article && $article->user_id == auth()->user()->id){
            $data = [
                'title' => $request->input('title'),
                'text' => $request->input('text'),
            ];
            if($request->has('img')){
                $imageName = $this->saveImage($request->file('img'));
                Storage::disk('public')->delete('/images/articles/'. $article->img);
                $data['img'] = $imageName;
            }
            $article->update($data);
        }
        return redirect()->route('home');
    }

    private function saveImage($image)
    {
        $imageName = Str::random(24) . '.' . $image->getClientOriginalExtension();
        while(Article::where('img', 'like', $imageName)->exists()){
            $imageName = Str::random(24) . '.' . $image->getClientOriginalExtension();
        }
        Storage::disk('public')->put('/images/articles/'. $imageName,  file_get_contents($image));
        return $imageName;
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if($article && $article->user_id == auth()->user()->id){
            Storage::disk('public')->delete('/images/articles/'. $article->img);
            $article->delete();
        }
        return redirect()->route('home');
    }
}