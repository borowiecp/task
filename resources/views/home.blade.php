@extends('layouts.master')

@section('content')  
    @if($articles->isNotEmpty())
        <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic">{{ $articles->first()->title }}</h1>
            <small>{{ $articles->first()->user->name . ', ' . $articles->first()->created_at }}</small>
            <p class="lead my-3">{{ substr($articles->first()->text, 0, 50) }}</p>
            <p class="lead mb-0"><a href="{{ route('articles.show', ['id' => $articles->first()->id]) }}" class="text-white font-weight-bold">Continue reading...</a></p>
            </div>
        </div>

        @if ($articles->count() > 1)
            <div class="row mb-2">
            @foreach ($articles->slice(1) as $article)
                <div class="col-md-6">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <h3 class="mb-0">{{ $article->title }}</h3>
                            <div class="mb-1 text-muted">{{ $article->user->name . ', ' . $article->created_at }}</div>
                            <p class="card-text mb-auto">{{ substr($article->text, 0, 30) }}</p>
                            <a href="{{ route('articles.show', ['id' => $article->id]) }}" class="stretched-link">Continue reading</a>
                        </div>
                    </div>
                </div>  
            @endforeach   
            </div>       
        @endif

    @endif
@endsection
