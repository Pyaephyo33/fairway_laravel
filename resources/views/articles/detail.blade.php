@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        @if (session('add'))
            <div class="alert alert-info">
                {{ session('add') }}
            </div>
        @endif

        @if (session('del'))
            <div class="alert alert-warning">
                {{ session('del') }}
            </div>
        @endif

        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $article->title }}
                </h5>

                <div class="card-subtitle mb-2 text-muted small">
                    <b class="text-success">{{ $article->user->name }}</b>
                    {{ $article->created_at->diffForHumans() }}
                    Category: <b>{{ $article->category->name }}</b>
                </div>

                <p class="card-text">
                    {{ $article->body }}
                </p>

                @auth()
                    @can('article-delete', $article)
                        <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-primary">
                            Edit
                        </a>
                        <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-danger">
                            Delete
                        </a>
                    @endcan
                    {{-- <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-danger">
                        Delete
                    </a> --}}
                @endauth
            </div>
        </div>

        <ul class="list-group mb-3">
            <li class="list-group-item active">
                <b>Comments ({{ count($article->comments) }})</b>
            </li>
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    <b class="text-success">{{ $comment->user->name }}</b>,
                    {{ $comment->created_at->diffForHumans() }}<br>

                    {{ $comment->content }}

                    @can('comment-delete', $comment)
                        <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                    @endcan
                </li>
            @endforeach
        </ul>

        @auth()
            <form action="{{ url('/comments/add') }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" id="" cols="30" rows="10" class="form-control mb-2"
                    placeholder="New Comment"></textarea>
                <input type="submit" value="Add Comment" class="btn btn-primary">
            </form>
        @endauth
    </div>
@endsection
