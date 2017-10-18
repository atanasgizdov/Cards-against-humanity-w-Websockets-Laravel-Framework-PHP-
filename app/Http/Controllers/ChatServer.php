<?php

namespace App\Http\Controllers;

use Ratchet\Server\IoServer;
use App\Http\Controllers\WebSocketController;

    require '../vendor/autoload.php';

    $server = IoServer::factory(
        new WebSocketController(),
        8080
    );

    $server->run();
