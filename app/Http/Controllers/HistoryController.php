<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Week;
use App\Models\History_track;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HistoryController extends Controller
{
    public function index()
    {
        $weeks = Week::all();


        return view('history.index', [
            'weeks' => $weeks,
        ]);
    }

    public function show($id)
    {
        $user = Auth::user();

        $topTenTracks = History_track::select('history_tracks.*')
            ->where('week_id', '=', $id)
            ->orderBy('top_ten_rank')
            ->get();

        $topFiveTracks = History_track::select('history_tracks.*')
            ->where('week_id', '=', $id)
            ->orderBy('top_five_rank')
            ->take(5)
            ->get();

        return view('history.show', [
            'topTenTracks' => $topTenTracks,
            'topFiveTracks' => $topFiveTracks,
            'number' => 0,
            'user' => $user,
        ]);
    }
}
