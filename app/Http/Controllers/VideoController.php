<?php

namespace App\Http\Controllers;

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
        $validated = $request->validate([
            'title' => 'required|string|min:5',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|video|mimes:mp4,mkv|max:2048',
        ]);
    }
}
