<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Track;
use Auth;

class FavoriteController extends Controller
{
    public function show()
    {
        $favorites = Favorite::select('favorites.*')
            ->join('tracks', 'favorites.track_id', '=', 'tracks.id')
            ->where('favorites.user_id', '=', Auth::user()->id)
            ->with([
                'track'
            ])
            ->get();

        return view('favorite.show', [
            'favorites' => $favorites
        ]);
    }

    public function add($id)
    {
        $favorite = new Favorite();
        $favorite->track_id = $id;
        $favorite->user_id = Auth::user()->id;
        $favorite->save();

        return redirect()
            ->route('home.index')
            ->with('success', "Successfully added to favorites");
    }

    public function delete($id)
    {
        $favorite = Favorite::find($id);
        $favorite->delete();

        return redirect()
            ->route('favorite.show')
            ->with('success', "Successfully removed from favorites");
    }
}
