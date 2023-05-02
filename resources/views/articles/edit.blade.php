@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-warning">
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif

        <form action="" method="post">
            @csrf
            <div class="mb-3">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $article->title }}">
            </div>

            <div class="mb-3">
                <label for="">Body</label>
                <textarea name="body" id="" cols="30" rows="10" class="form-control">{{ $article->body }}</textarea>
            </div>

            <div class="mb-3">
                <label for="">Category</label>
                <select name="category_id" id="" class="form-select">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{-- {{ $category->id === $article->category_id ? 'selected' : '' }} --}}
                            @if($category->id === $article->category_id)
                                selected
                            @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="submit" class="btn btn-primary" value="Update Article">
        </form>
    </div>
@endsection
