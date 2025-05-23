<?php

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
    Route::get('/crear-video', [VideoController::class, 'createVideo'])->name('createVideo');
    Route::post('/Sguardar-video', [VideoController::class, 'saveVideo'])->name('saveVideo');

});
Route::group([], base_path('./routes/auth.php'));



//require __DIR__.'/auth.php';
