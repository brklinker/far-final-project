@extends("layouts.anr")

@section('title', 'A&R')

@section("left-col")
<h1>Welcome, {{$user->name}}</h1>
<h5>Here are this week's Top 5 curated by the fans.</h5>
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
    @foreach($topFiveTracks as $track)
    <tr>
        <td>
            {{$number += 1}}
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
@section("right-col")
<div id="right-header">
    <h1>Here is FA&R's Top 10 of the week.</h1>
    <h5>This is the same Top 10 that fans see to rank their Top 3.</h5>
</div>
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
    @foreach($topTenTracks as $track)
    <tr>
        <td>
            {{$track->top_ten_rank}}
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