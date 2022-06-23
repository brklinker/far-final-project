<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Playlist;
use App\Models\Track;
use App\Models\User_track;
use App\Models\History_track;
use App\Models\Week;
use Spotify;
use DB;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }


    public function update(Request $request)
    {

        $oldWeek = Week::find(DB::table('weeks')->max('id'));
        $oldWeek->stop_day = date("Y-m-d");
        $oldWeek->save();

        $tracks = Track::select('tracks.*')
            ->orderBy('score', 'desc')
            ->get();

        $counter = 1;
        foreach ($tracks as $track) {
            $historyTrack = new History_track();
            $historyTrack->name = $track->name;
            $historyTrack->preview_url = $track->preview_url;
            $historyTrack->spotify_id = $track->spotify_id;
            $historyTrack->artist =  $track->artist;
            $historyTrack->album = $track->album;
            $historyTrack->album_id = $track->album_id;
            $historyTrack->album_cover = $track->album_cover;
            $historyTrack->top_ten_rank = $track->id;
            $historyTrack->week_id = $oldWeek->id;
            if ($counter <= 5) {
                $historyTrack->top_five_rank = $counter;
                $counter++;
            }
            $historyTrack->save();
        }

        $newWeek = new Week();
        $newWeek->start_day = now();
        $newWeek->save();

        Track::truncate();
        User_track::truncate();

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

            if ($spotifyTrack['preview_url'] == null) {
                $spotifyTrack = Spotify::track($keys[50])->get();
            }
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
