@extends('layouts.main')

@section('title', 'Comments')

@section('nav-bar')
<a class="navbar-brand" href=" {{route('home.submitted') }}" id=" nav-bar-button">FA&R</a>

<a class="navbar-brand" href="{{route('favorite.show')}}" id="nav-bar-button">Favorite</a>
@endsection

@section("left-col")
<h1>Comments</h1>
@if(count($comments) == 0)
<h5>No comments yet!</h5>
@endif
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
<table class=" table table-striped">
    <thead>
        <tr>
            <th>At</th>
            <th>From</th>
            <th colspan="2">Comment</th>
        </tr>
    </thead>
    @foreach($comments as $comment)
    <tr>
        <td>
            {{date_format($comment->created_at, 'n/j/Y')}} at {{date_format($comment->created_at, 'g:i A')}}
        </td>
        <td>
            {{$comment->user_name}}
        </td>
        <td>
            {{$comment->text_body}}
        </td>
        <td>
            @can('edit-comment', $comment)
            <a href="{{ route('comment.edit', [ 'id' => $comment->id]) }}">
                Edit
            </a>
            @endcan
        </td>
    </tr>
    @endforeach
</table>
@endsection
@section("right-col")
<div id="right-header">

    <form action="{{ route('comment.create', [ 'id' => $id ]) }}" method="POST">
        @csrf
        <h1>Add a Comment</h1>
        <div class="row song-row">
            <textarea id="text_body" name="text_body" class="form-control" rows="3"></textarea>
        </div>
        <div class="row">
            <div class="mb-3">
                <input type="submit" value="Comment" class="btn btn-primary" id="form-submit">
            </div>
        </div>
    </form>

</div>
@endsection