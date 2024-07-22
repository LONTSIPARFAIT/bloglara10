<?php

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
    return view('welcome');
});

Route::get('/hello', function () {
    return string('hello');
});

Route::get('/data', function () {
    return [
        "name"=> "cours complet laravel10",
        "lang" => "php,js",
        "age" => "14"
    ];
});

Route::get('/{name}', function (string $name) {
    return "Hello " . $name;
});

Route::get('/posts/{id}', function (int $id) {
    return 'posts '.$id;
});
