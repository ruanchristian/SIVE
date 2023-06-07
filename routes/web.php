<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\StudentController;

Route::get('/', function () {
    return to_route('login');
});

Route::get('painel', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::controller(StudentController::class)->name('student.')->group(function () {
    Route::get('painel-votacao', 'index')->name('index');
    Route::get('sair', 'destroy')->name('destroy');
});

Route::controller(ProfileController::class)->middleware('auth')->name('profile.')->group(function () {
    Route::get('perfil', 'edit')->name('edit');
    Route::patch('perfil', 'update')->name('update');
    Route::delete('perfil', 'destroy')->name('destroy');
});

require __DIR__ . '/auth.php';