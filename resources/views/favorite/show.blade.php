@extends('layouts.anr')

@section('title', 'Favorites')

@section('nav-bar')
<a class="navbar-brand" href=" {{route('home.submitted') }}" id=" nav-bar-button">FA&R</a>

<a class="navbar-brand" href="{{route('favorite.show')}}" id="nav-bar-button">Favorite</a>
@endsection

@section("left-col")

<h1>Favorites</h1>

@if(count($favorites) == 0)
<h5>No favorites yet!</h5>
@endif
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
<table class=" table table-striped">
    <thead>
        <tr>
            <th>Favorited At</th>
            <th>Cover</th>
            <th>Track</th>
            <th>Artist</th>
            <th>Album</th>
        </tr>
    </thead>
    @foreach($favorites as $favorite)
    <tr>
        <td>
            {{date_format($favorite->created_at, 'n/j/Y')}} at {{date_format($favorite->created_at, 'g:i A')}}
        </td>
        <td>
            <img src="{{$favorite->track->album_cover}}" alt="{{$favorite->track->album}}" class="cover-img">
        </td>
        <td>
            {{$favorite->track->name}}
        </td>
        <td>
            {{$favorite->track->artist}}
        </td>
        <td>
            {{$favorite->track->album}}
        </td>
        <td>
            <audio controls>
                <source src=" {{$favorite->track->preview_url}}" type="audio/mp3">
            </audio>
        </td>
        <td>
            <form action="{{ route('favorite.delete',  [ 'id' => $favorite->id ] )}}" method="POST">
                @csrf
                <input type="submit" value="Unfavorite" class="btn btn-primary" id="form-submit">
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection