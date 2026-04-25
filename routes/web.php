<?php
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
Route::inertia('/', 'Welcome', ['canRegister' => Features::enabled(Features::registration())])->name('home');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    Route::resource('shifts', ShiftController::class);
    Route::resource('users', UserController::class);
});
require __DIR__.'/settings.php';