@extends('layouts.master')

@section('content')
    @auth
        @if (auth()->user()->id == $article->user_id)
            <div class="row mb-2">
                <div class="col-12 text-right">
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('articles.edit', ['id' => $article->id]) }}">Edit</a>
                    <a class="btn btn-sm btn-outline-secondary ml-1" data-toggle="modal" data-target="#deleteModal">Delete</a>
                </div>
            </div>
            
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('articles.delete', ['id' => $article->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                Do you want delete this article?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">Yes</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>

            <script>
                $('#myModal').modal('toggle');
            </script>
        @endif
    @endauth
    <div class="row">
        <div class="col-12">
            <div class="article-image w-100 text-center mb-5">
                <img src="{{ asset('storage/images/articles/' . $article->img) }}" alt="Article Photo">
            </div>
        </div>
        <div class="col-12 text-center mb-5">
            <h1>{{ $article->title }}</h1>
            <small>{{ $article->user->name . ', ' . $article->created_at }}</small>
        </div>
        <div class="col-12 text-center mb-5">
            <p>{{ $article->text }}</p>
        </div>
    </div>
    @if ($article->comments->isNotEmpty())
        <div class="row">
            <div class="col-12 mb-1">
                Comments:
            </div>
            @foreach ($article->comments as $comment)
                <div class="col-12 mb-1">
                    <small>{{ $comment->user->name . ', ' . $comment->created_at }}</small>
                    <div class="alert alert-dark" role="alert">
                        {{ $comment->comment }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @auth
        @if ($article->user_id != auth()->user()->id)    
            <form action="{{ route('comments.create', ['id' => $article->id]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="mb-1">Post Your comment</p>
                        <div class="form-group">
                            <textarea class="form-control" aria-label="With textarea" required name="comment"></textarea>
                        </div>
                    </div>
                    <div class="col-12 mb-5 text-right">
                        <button class="btn btn-sm btn-outline-secondary ml-1" type="submit">Add Comment</button>
                    </div>
                </div>
            </form>
        @endif   
    @endauth
    @if ($errors->any())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
@endsection
