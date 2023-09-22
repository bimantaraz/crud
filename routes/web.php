<?php

use App\Http\Controllers\mahasiswaConttroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});


Route::resource('mahasiswa', mahasiswaConttroller::class)
    ->except(['show'])
    ->parameter('mahasiswa', 'mahasiswa:nim');
