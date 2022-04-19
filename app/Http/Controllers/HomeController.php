<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Track;
use App\Models\User_track;
use Spotify;

class HomeController extends Controller
{
    public function index()
    {
        $tracks = Track::all()->sortBy('id');
        $user = Auth::user();

        return view('home.index', [
            'tracks' => $tracks,
            'user' => $user,
        ]);
    }

    public function submitted()
    {
        $tracks = Track::all()->sortBy('id');
        $user = Auth::user();

        $topTracks = Track::select('tracks.*')
            ->join('user_tracks', 'tracks.id', '=', 'user_tracks.track_id')
            ->where('user_tracks.user_id', '=', Auth::user()->id)
            ->orderBy('rank')
            ->get();

        return view('home.submitted', [
            'tracks' => $tracks,
            'topTracks' => $topTracks,
            'user' => $user,
        ]);
    }

    public function submit(Request $request)
    {
        $user = Auth::user();

        $firstTrack = new User_track();
        $firstTrack->user_id = $user->id;
        $firstTrack->track_id = (int)$request->input('top-song');
        $firstTrack->rank = 1;
        $firstTrack->save();

        $firstSong = Track::where('id', $firstTrack->track_id)->first();
        $firstSong->score += 3;
        $firstSong->save();


        $secondTrack = new User_track();
        $secondTrack->user_id = $user->id;
        $secondTrack->track_id = (int)$request->input('second-song');
        $secondTrack->rank = 2;
        $secondTrack->save();

        $secondSong = Track::where('id', $secondTrack->track_id)->first();
        $secondSong->score += 2;
        $secondSong->save();

        $thirdTrack = new User_track();
        $thirdTrack->user_id = $user->id;
        $thirdTrack->track_id = (int)$request->input('third-song');
        $thirdTrack->rank = 3;
        $thirdTrack->save();


        $thirdSong = Track::where('id', $thirdTrack->track_id)->first();
        $thirdSong->score += 1;
        $thirdSong->save();


        return redirect()
            ->route('home.submitted');
    }
}
