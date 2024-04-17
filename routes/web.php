<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', function (){ return redirect()->route("welcome"); })->name('dashboard')->middleware("auth","verified");

Route::get('/',[\App\Http\Controllers\HomeController::class,'welcome'])->name('welcome')->middleware("auth","verified");
Route::post('/api/language',[\App\Http\Controllers\HomeController::class,'language'])->name('language')->middleware("auth","verified");
Route::post('/api/main',[\App\Http\Controllers\HomeController::class,'main'])->name('main')->middleware("auth","verified");
Route::post('/api/phone',[\App\Http\Controllers\HomeController::class,'phone'])->name('phone')->middleware("auth","verified");
Route::post('/api/accept',[\App\Http\Controllers\HomeController::class,'accept'])->name('accept')->middleware("auth","verified");
Route::post('/api/phone_incorrectly',[\App\Http\Controllers\HomeController::class,'phone_incorrectly'])->name('phone_incorrectly')->middleware("auth","verified");
Route::post('/api/JustAccept',[\App\Http\Controllers\HomeController::class,'JustAccept'])->name('JustAccept')->middleware("auth","verified");
Route::post('/api/save_data',[\App\Http\Controllers\HomeController::class,'save_data'])->name('save_data')->middleware("auth","verified");
