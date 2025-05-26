<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Video $video)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $video->comments()->create([
            'body' => $validated['content'],
            
            'user_id' => auth()->id()
        ]);

        return redirect()
                ->route('verVideo', ['video_id' => $video->id])
                ->with('success', 'Comentario agregado correctamente.');
    }

    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            return redirect()
               ->route('verVideo', $comment->video->id)
               ->with('success', 'Comentario eliminado correctamente');
        } catch (ModelNotFoundException $e) {
            return redirect()
               ->route('verVideo', $comment->video->id)
               ->with('error', 'Comentario no existe o ya fue eliminado');
        }
    }
}
