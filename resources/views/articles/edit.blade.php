@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center mb-5 mt-5">
            <h1>Create Article</h1>
        </div>
    </div>
    <form action="{{ route('articles.update', ['id' => $article->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
                    </div>
                    <input value="{{ $article->title }}" type="text" name="title" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">Article Body</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" required name="text">{{ $article->text }}</textarea>
                </div>
            </div>
            <div class="col-12 mb-3">
                <input type="file" class="form-control" name='img' accept="image/png, image/jpeg">
            </div>
            <div class="col-12 text-right">
                <button class="btn btn-sm btn-outline-secondary" type="submit">Save</button>
            </div>
        </div>
    </form>
    @if ($errors->any())
    <div class="row mt-3">
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
