<?php

use App\Models\Pet;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();


Route::post('/add-pet', 'PetController@create')->name('add-pet');

Route::post('/update-pet/{id}', 'PetController@update')->name('update-pet');

Route::get('/delete-pet/{id}', function ($id) {
    Pet::where('id', $id)->delete();
    return redirect('/pet-personal');
});

Route::get('/edit-pet/{id}', function ($id) {
    $data = Pet::where('id', $id)->first();
    return view('pet.edit', ["result" => $data]);
});

Route::get('/', function () {
    $data = Pet::getPets();
    return view('home', ["results" => $data]);
});

Route::get('/home', function () {
    $data = Pet::getPets();
    return view('home', ["results" => $data]);
})->name('home');

Route::get('/pet-register', function () {
    return view('pet.register');
})->name('pet-register')->middleware('auth');;

Route::get('/pet-personal', function () {
    $data = Pet::where('fk_user_id', auth()->user()->id)->get();
    return view('pet.personal', ["results" => $data]);
})->name('pet-personal')->middleware('auth');;
