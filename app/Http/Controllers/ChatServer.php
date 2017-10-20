<?php

use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;
use App\Http\Controllers\WebSocketController;

$server = null;

    require '../vendor/autoload.php';
    

    $server = IoServer::factory(
         new HttpServer(
             new WsServer(
                 new WebSocketController()
             )
         ),
         8008
     );
     $server->loop->stop();
     $server->run();
