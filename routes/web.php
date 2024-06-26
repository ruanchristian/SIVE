<?php

use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\Election\ElectionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\StudentController;

Route::get('/', function () {return to_route('login');});

Route::get('painel', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::controller(ElectionController::class)->middleware('auth')->name('election.')->group(function () {
    Route::get('criar-eleicao', 'index')->name('index');
    Route::get('editar-eleicao/{id}', 'index')->name('edit');
    Route::get('visualizar', 'visualizar')->name('seeall');
    Route::get('acompanhar-votacao/{id}/{ajax?}', 'acompanhar')->name('result');
    Route::get('salvar-resultado/{election}', 'pagina_impressao')->name('print');
    Route::post('criar-eleicao', 'store')->name('store');
    Route::put('editar-eleicao/{id}', 'update')->name('update');
});

Route::controller(CandidateController::class)->middleware('auth')->name('candidate.')->group(function () {
    Route::get('criar-chapa/{election?}', 'index')->name('index');
    Route::get('editar-chapa/{id}', 'edit')->name('edit');
    Route::get('chapas', 'visualizar')->name('seeall');
    Route::post('criar-chapa/{election}', 'store')->name('store');
    Route::put('editar-chapa/{id}', 'update')->name('update');
});

Route::controller(ProfileController::class)->middleware('auth')->name('profile.')->group(function () {
    Route::get('perfil', 'edit')->name('edit');
    Route::patch('perfil', 'update')->name('update');
    Route::delete('perfil', 'destroy')->name('destroy');
});

Route::controller(StudentController::class)->name('student.')->group(function () {
    Route::get('eleicoes', 'index')->name('index');
    Route::get('urna/{id}', 'urna')->name('urna');
    Route::get('buscar-chapa/{election}', 'buscarChapa')->name('buscar-chapa');
    Route::get('sair', 'destroy')->name('destroy');
    Route::get('cadastrar', 'cadastrar')->name('create');
    Route::post('criar', 'store')->name('save-student');
    Route::post('salvar/{election}', 'salvarVoto')->name('vote');
});

require __DIR__ . '/auth.php';