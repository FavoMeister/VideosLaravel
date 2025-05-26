<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $videos = App\Models\Video::latest()->paginate(5);
    return view('welcome', ['videos' => $videos]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('web')->group(function () {
    Route::get('/videos', [VideoController::class, 'index'])->name('verVideos');
    Route::get('/video/{video_id}', [VideoController::class, 'getVideoPage'])->name('verVideo');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Video Routes
    
    Route::get('/crear-video', [VideoController::class, 'createVideo'])->name('createVideo');
    Route::post('/guardar-video', [VideoController::class, 'saveVideo'])->name('saveVideo');
    Route::get('/miniatura/{filename}', [VideoController::class, 'getImage'])->name('imageVideo');
    
    Route::delete('eliminar-video/{video}', [VideoController::class, 'destroy'])->name('delete.video');
    Route::get('editar-video/{video}', [VideoController::class, 'edit'])->name('edit.video');
    Route::put('actualizar-video/{video}', [VideoController::class, 'update'])->name('update.video');

    // Comments
    Route::post('/registrar-comentario/{video}', [CommentController::class, 'store'])->name('comment');
    Route::delete('eliminar-comentario/{comment}', [CommentController::class, 'destroy'])->name('deleteComment');

});
Route::group([], base_path('./routes/auth.php'));



//require __DIR__.'/auth.php';
