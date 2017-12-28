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


#Route::get('/', 'PokerGameController@show');

Route::get('/', 'PokerGameController@show');

Route::get('/create', 'PokerGameController@createGameView');

Route::get('/play', 'PokerGameController@startGame');

Route::get('/create_card', 'PokerGameController@createCard');

Route::get('/delete_card', 'PokerGameController@deleteCard');

Route::post('/enterName', 'PokerGameController@enterName');

Route::post('/join', 'PokerGameController@joinGame');

Route::get('/admin', 'PokerGameController@admin');





Route::get('/env', function () {
    dump(config('app.name'));
    dump(config('app.env'));
    dump(config('app.debug'));
    dump(config('app.url')) ;
});

// DB Debug and connection info

Route::get('/debug', function () {

    $query = DB::table('cards')->where('card_id', '1')->first();
    dump($query);

    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});
