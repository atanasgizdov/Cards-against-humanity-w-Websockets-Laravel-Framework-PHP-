<?php

use App\Http\Controllers\PokerGameController;
use App\Http\Controllers\ChatServer;


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

Route::get('/example', function () {
    return 'hello there!';
});


Route::get('/', 'ChatServer@show');

#Route::get('/', 'ChatServer');


Route::get('/example/{id}', function($title) {
    return 'You have requested book #'.$title;
});


Route::get('/env', function () {
    dump(config('app.name'));
    dump(config('app.env'));
    dump(config('app.debug'));
    dump(config('app.url')) ;
});
