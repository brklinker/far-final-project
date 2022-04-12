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
        $randomTracks = array();
        $iteratorTop = 0;
        $iteratorRandom = 0;

        foreach ($playlists as $playlist) {
            //dd($playlist);
            $tracks = Spotify::playlistTracks($playlist->spotify_id)->get();
            //dd($tracks);
            foreach ($tracks['items'] as $track) {
                //dd($track);
                $id = $track['track']['id'];
                if (array_key_exists($id, $songRank)) {
                    $songRank[$id] = $songRank[$id] + 1;
                    $topTracks[$iteratorTop] = $id;
                    $iteratorTop++;
                } else {
                    $songRank[$id] = 1;
                }

                if (random_int(0, 50) == 0) {
                    if (!array_key_exists($id, $topTracks)) {
                        $randomTracks[$iteratorRandom] = $id;
                        $iteratorRandom++;
                    }
                }
            }
        }

        $j = 0;
        for ($i = sizeof($topTracks); $i < 10; $i++) {
            $topTracks[$i] = $randomTracks[$j];
            $j = $j + 1;
        }

        $rank = 1;
        foreach ($topTracks as $track) {
            $spotifyTrack = Spotify::track($track)->get();
            //dd($spotifyTrack);
            $newTrack = new Track();
            $newTrack->name = $spotifyTrack['name'];
            $newTrack->preview_url = $spotifyTrack['preview_url'];
            $newTrack->spotify_id = $spotifyTrack['id'];
            $newTrack->artist = $spotifyTrack['artists'][0]['name'];
            $newTrack->album = $spotifyTrack['album']['name'];
            $newTrack->album_id = $spotifyTrack['album']['id'];
            $newTrack->album_cover = $spotifyTrack['album']['images'][0]['url'];
            $newTrack->rank = $rank;

            $newTrack->save();
            $rank++;
        }

        return redirect()->route('admin.index');
    }
}
