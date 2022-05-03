@extends('layouts.main')

@section('title', 'Edit Comment')

@section('nav-bar')
<a class="navbar-brand" href=" {{route('home.submitted') }}" id=" nav-bar-button">FA&R</a>

<a class="navbar-brand" href="{{route('favorite.show')}}" id="nav-bar-button">Favorite</a>
@endsection

@section("left-col")
<form action="{{ route('comment.update', [ 'id' => $comment->id ]) }}" method="POST">
    @csrf
    <h1>Edit Comment</h1>

    <textarea id="text_body" name="text_body" class="form-control" rows="3">{{ old('text_body', $comment->text_body) }}
    </textarea>
    <div class="row">
        <div class="mb-3">
            <input type="submit" value="Update" class="btn btn-primary" id="form-submit">
        </div>
    </div>
</form>

@endsection

@section("right-col")
<form action="{{ route('comment.delete', [ 'id' => $comment->id ]) }}" method="POST">
    @csrf
    <h1>Delete Comment</h1>
    <div class="row">
        <div class="mb-3">
            <input type="submit" value="Delete" class="btn btn-danger" id="form-submit">
        </div>
    </div>
</form>


@endsection