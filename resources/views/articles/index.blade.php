@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('add'))
            <div class="alert alert-info">
                {{ session('add') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-warning">
                {{ session('info') }}
            </div>
        @endif

        {{ $articles->links() }}

        @foreach ($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $article->title }}
                    </h5>

                    <div class="card-subtitle mb-2 text-muted small">
                        <b class="text-success">{{ $article->user->name }}</b>
                        <b>Category: {{ $article->category->name }},</b>
                        <b>Comments ({{ count($article->comments) }}),</b>
                        {{ $article->created_at->diffForHumans() }}
                    </div>

                    <p class="card-text">
                        {{ $article->body }}
                    </p>

                    <a href="{{ url("/articles/detail/$article->id") }}" class="card-link">
                        View Detail &raquo;
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
