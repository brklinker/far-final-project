@extends('layouts.main')

@section('title', 'Submitted')

@section("left-col")

@section('nav-bar')
<a class="navbar-brand" href=" {{route('home.submitted') }}" id=" nav-bar-button">FA&R</a>

<a class="navbar-brand" href="{{route('favorite.show')}}" id="nav-bar-button">Favorite</a>
@endsection

@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
<h1>Welcome back, {{$user->name}}</h1>
<h5>Here are this week's Top 10 tracks.</h5>
<table class=" table table-striped">
    <thead>
        <tr>
            <th>Rank</th>
            <th>Cover</th>
            <th>Track</th>
            <th>Artist</th>
            <th>Album</th>
        </tr>
    </thead>
    @foreach($tracks as $track)
    <tr>
        <td>
            {{$track->id}}
        </td>
        <td>
            <img src="{{$track->album_cover}}" alt="{{$track->album}}" class="cover-img">
        </td>
        <td>
            {{$track->name}}
        </td>
        <td>
            {{$track->artist}}
        </td>
        <td>
            {{$track->album}}
        </td>
        <td>
            <audio controls>
                <source src=" {{$track->preview_url}}" type="audio/mp3">
            </audio>
        </td>
        <td>
            <a href="{{ route('comment.show', [ 'id' => $track->id ]) }}">
                Comment
            </a>
            <form action="{{ route('favorite.add', [ 'id' => $track->id ]) }}" method="POST">
                @csrf
                <input type="submit" value="Favorite" class="btn btn-primary" id="form-submit">
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
@section("right-col")
<div id="right-header">
    <h1>Here's Your Top 3</h1>
    <h5>Your ranked Top three.</h5>
</div>
<table class=" table table-striped">
    <thead>
        <tr>
            <th>Track</th>
            <th>Artist</th>
        </tr>
    </thead>
    @foreach($topTracks as $track)
    <tr>
        <td>
            {{$track->name}}
        </td>
        <td>
            {{$track->artist}}
        </td>
    </tr>
    @endforeach
</table>

@endsection