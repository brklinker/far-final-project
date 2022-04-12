<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Track;

class ANRController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $topTenTracks = Track::all()->sortBy('id');
        $topFiveTracks = Track::select('tracks.*')
            ->orderBy('score', 'desc')
            ->take(5)
            ->get();

        return view('anr.index', [
            'topTenTracks' => $topTenTracks,
            'topFiveTracks' => $topFiveTracks,
            'number' => 0,
            'user' => $user,
        ]);
    }
}
