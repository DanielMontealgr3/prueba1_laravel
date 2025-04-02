
<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/home', [UsuarioController::class, 'index'])->name('home');
Route::resource('/', UsuarioController::class);





