<?php
use App\Http\Controllers\PokerGameController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return PokerGameController::startGame();
});

Route::get('/', function () {
    return PokerGameController::endGame();
});

Route::get('/example/{id}', function($title) {
    return 'You have requested book #'.$title;
});
