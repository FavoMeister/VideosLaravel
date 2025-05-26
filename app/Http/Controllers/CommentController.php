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
                ->route('verVideo', $video->id)
                ->with('success', 'Comentario agregado correctamente.');
    }

    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            return back()->with('error', 'No tienes permiso para eliminar este comentario');
        }
        try {
            $videoId = $comment->video_id;
            $comment->delete();
            return redirect()
                ->route('verVideo', $videoId)
                ->with('success', 'Comentario eliminado correctamente');
            
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Ocurrió un error al eliminar el comentario');
        }
    }
}
