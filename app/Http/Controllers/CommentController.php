<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class CommentController extends Controller
{
    public function show($id)
    {
        $comments = Comment::select('comments.*')
            ->join('tracks', 'tracks.id', '=', 'comments.track_id')
            ->where('tracks.id', '=', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('comment.show', [
            'comments' => $comments,
            'id' => $id
        ]);
    }

    public function create($id, Request $request)
    {
        $comment = new Comment();
        $comment->user_name = Auth::user()->name;
        $comment->text_body = $request->input('text_body');
        $comment->user_id = Auth::user()->id;
        $comment->track_id = $id;
        $comment->save();


        return redirect()
            ->route('comment.show', ['id' => $id])
            ->with('success', "Successfully added comment");
    }

    public function edit($id)
    {

        $comment = Comment::find($id);

        if (Gate::denies('view-comment', $comment)) {
            abort(403);
        }

        return view('comment.edit', [
            'comment' => $comment,
        ]);
    }

    public function update($id, Request $request)
    {
        $comment = Comment::find($id);
        $comment->text_body = $request->input('text_body');
        $comment->save();

        return redirect()
            ->route('comment.show', ['id' => $comment->track_id])
            ->with('success', "Successfully edited comment");
    }

    public function delete($id)
    {

        $comment = Comment::find($id);
        $track_id = $comment->track_id;
        $comment->delete();

        return redirect()
            ->route('comment.show', ['id' => $track_id])
            ->with('success', "Successfully deleted comment");
    }
}
