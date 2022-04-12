<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Playlist;
use App\Models\Track;
use Spotify;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }


    public function update(Request $request)
    {
        Track::truncate();

        $playlists = Playlist::all();
        //dd($playlists);
        $songRank = array();
        $topTracks = array();

        foreach ($playlists as $playlist) {
            //dd($playlist);
            $tracks = Spotify::playlistTracks($playlist->spotify_id)->get();
            //dd($tracks);
            foreach ($tracks['items'] as $track) {
                //dd($track);
                $id = $track['track']['id'];
                if (array_key_exists($id, $songRank)) {
                    $songRank[$id] = $songRank[$id] + 1;
                } else {
                    $songRank[$id] = 1;
                }
            }
        }

        uasort($songRank, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a > $b) ? -1 : 1;
        });

        $keys = array_keys($songRank);

        for ($i = 0; $i < 10; $i++) {
            $topTracks[$i] = $keys[$i];
        }


        foreach ($topTracks as $track) {
            $spotifyTrack = Spotify::track($track)->get();
            $newTrack = new Track();
            $newTrack->name = $spotifyTrack['name'];
            $newTrack->preview_url = $spotifyTrack['preview_url'];
            $newTrack->spotify_id = $spotifyTrack['id'];
            $newTrack->artist = $spotifyTrack['artists'][0]['name'];
            $newTrack->album = $spotifyTrack['album']['name'];
            $newTrack->album_id = $spotifyTrack['album']['id'];
            $newTrack->album_cover = $spotifyTrack['album']['images'][0]['url'];

            $newTrack->save();
        }

        return redirect()->route('admin.index');
    }
}
