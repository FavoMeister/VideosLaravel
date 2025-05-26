<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Video Routes
    Route::get('/videos', [VideoController::class, 'index'])->name('verVideos');
    Route::get('/crear-video', [VideoController::class, 'createVideo'])->name('createVideo');
    Route::post('/guardar-video', [VideoController::class, 'saveVideo'])->name('saveVideo');
    Route::get('/miniatura/{filename}', [VideoController::class, 'getImage'])->name('imageVideo');
    Route::get('/video/{video_id}', [VideoController::class, 'getVideoPage'])->name('verVideo');

    // Comments
    Route::post('/registrar-comentario/{video}', [CommentController::class, 'store'])->name('comment');
    Route::delete('eliminar-comentario/{comment}', [CommentController::class, 'destroy'])->name('deleteComment');

});
Route::group([], base_path('./routes/auth.php'));



//require __DIR__.'/auth.php';
