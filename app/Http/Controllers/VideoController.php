<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'video' => 'nullable|video|mimes:mp4,mkv|max:2048',
        ]);
        $imgRoute = $request->hasFile('image') ? $request->image->store('images', 'public') : '';
        $videoRoute = $request->hasFile('video') ? $request->image->store('videos', 'public') : '';
        Video::create([
            ...$validated,
            'image' => $imgRoute,
            'video_path' => $videoRoute,
            'user_id' => Auth::id(),
        ]);

        return redirect('dashboard')->with('success', 'El video se ha subido correctamente.');
    }
}
