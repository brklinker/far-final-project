@extends('layouts.main')

@section('title', 'Home')


@section('left-col')
<h1>Welcome, {{$user->name}}</h1>
<h5>Here is this week's Top 10 tracks.</h5>
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
    </tr>
    @endforeach
</table>
@endsection

@section('right-col')
<form action="{{ route('home.submit') }}" method="POST">
    @csrf
    <div id="right-header">
        <h1>Your Top 3</h1>
        <h5>Choose your top 3 below.</h5>
    </div>

    <div class="row song-row">
        <label for="top-song">Top Song</label>
        <select name="top-song">
            @foreach($tracks as $track)
            <option value="{{$track->id}}"> {{$track->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="row song-row">
        <label for="second-song">Second Song</label>
        <select name="second-song">
            @foreach($tracks as $track)
            <option value="{{$track->id}}"> {{$track->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="row song-row">
        <label for="third-song">Third Song</label>
        <select name="third-song">
            @foreach($tracks as $track)
            <option value="{{$track->id}}"> {{$track->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="mb-3">
            <input type="submit" value="Submit" class="btn btn-primary" id="form-submit">
        </div>
    </div>
</form>
@endsection