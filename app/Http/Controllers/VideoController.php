<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Response;

class VideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('auth');
    } */

    public function index()
    {
        $videos = Video::orderBy('id', 'asc')->paginate(10);

        return view('video.table-videos')->with([
            'videos' => $videos
        ]);
    }

    public function createVideo()
    {
        /*if (!Auth::check() || Auth::user()->role != 'Administrator') {
            return redirect('index');
        }*/
        return view('video.createVideo');
    }

    public function saveVideo(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'title' => 'required|string|min:5',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|file|mimetypes:video/mp4,video/x-matroska|max:20480',
        ]);
        $imgRoute = $request->hasFile('image') ? $request->image->store('images', 'public') : '';
        $videoRoute = $request->hasFile('video') ? $request->video->store('videos', 'public') : '';
        Video::create([
            ...$validated,
            'image' => $imgRoute,
            'video_path' => $videoRoute,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('verVideos')->with('success', 'El video se ha subido correctamente.');
    }

    public function getImage($filename)
    {
        $file = Storage::disk('public')->get($filename);
        return new Response($file, 200);
    }

    public function getVideoPage($vide_id)
    {
        $video = Video::findOrFail($vide_id);

        return view('video.detail')->with([
            'video' => $video
        ]);
    }

    public function destroy(Video $video)
    {
        if (auth()->id() !== $video->user_id) {
            return back()->with('error', 'No tienes permiso para eliminar este video');
        }
        try {
            if ($video->image && Storage::disk('public')->exists($video->image)) {
                Storage::disk('public')->delete($video->image);
            }
            if ($video->video_path && Storage::disk('public')->exists($video->video_path)) {
                Storage::disk('public')->delete($video->video_path);
            }
            $video->comments()->delete();

            $video->delete();
            return redirect()
                ->route('verVideos')
                ->with('success', 'Video eliminado correctamente');
            
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Ocurrió un error al eliminar el video');
        }
    }
}
