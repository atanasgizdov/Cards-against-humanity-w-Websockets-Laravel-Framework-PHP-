<?php

namespace App\Http\Controllers;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PlayerClass;

class WebSocketController implements MessageComponentInterface {

    protected $clients;
    private $logs;
    private $connectedUsers;
    private $connectedUsersNames;
    private $connectedUsersObjects;

  public function __construct() {
      $this->clients = new \SplObjectStorage;
      $this->logs = [];
      $this->connectedUsers = [];
      $this->connectedUsersNames = [];
      $this->connectedUsersObjects = [];
  }

  public function onOpen(ConnectionInterface $conn) {
      // Store the new connection to send messages to later
      $this->clients->attach($conn);
      //dump($conn);
      echo "New connection! ({$conn->resourceId})\n";
      // send full list of logs to players (if needed)
      #$conn->send(json_encode($this->logs));
      $this->connectedUsers [$conn->resourceId] = $conn;
      // instantiate new player object
      $this->connectedUsersObjects [$conn->resourceId] = new Player ($conn->resourceId);
      dump($this->connectedUsersObjects);
      //$this->connectedUsersNames[$conn->resourceId] = $conn->resourceId;
      $conn->send(json_encode($this->connectedUsersNames));
  }

  public function onMessage(ConnectionInterface $from, $msg) {
       // Do we have a username for this user yet?
       if (isset($this->connectedUsersNames[$from->resourceId])) {
           // If we do, build JSON based on request

           //TODO separate out json building into methods based on JS input
           //TODO figure out way to determine request type passed from JS


           $this->buildBulkMessage($from, $msg);
           //$this->buildSingleMessage($from, $msg);


       } else {
           // If we don't this message will be their username
           $this->connectedUsersNames[$from->resourceId] = $msg;
           // loop through each connected users object to find if object matching UN exists - if so, update UN
           foreach ($this->connectedUsersObjects as $user) {
               if ($user->getPlayerId() == $from->resourceId ) {
                    $user->updateUserName($msg);

               }
           }

           dump($this->connectedUsersObjects);


       }
   }

  public function onClose(ConnectionInterface $conn) {
      // The connection is closed, remove it, as we can no longer send it messages
      $this->clients->detach($conn);
      unset($this->connectedUsersNames[$conn->resourceId]);
      unset($this->connectedUsers[$conn->resourceId]);
      unset($this->connectedUsersObjects[$conn->resourceId]);
      dump($this->connectedUsersObjects);
      echo "Connection {$conn->resourceId} has disconnected\n";
  }

  public function onError(ConnectionInterface $conn, \Exception $e) {
      echo "An error has occurred: {$e->getMessage()}\n";

      $conn->close();
  }

// based on message passed and from whom, build a generic message to return as a JSON object - call function to send to single player

private function buildSingleMessage ($from, $msg) {
   $this->sendSingleMessage($from, "private hello");
}

// send message as JSON to just user who sent it, based on message passed
  private function sendSingleMessage($from, $message) {
        foreach ($this->connectedUsersObjects as $user) {
          if ($user->getPlayerId() == $from->resourceId ) {
             $user->send(json_encode($message));
          }
        }
}

 // based on message passed and from whom, build a generic message to return as a JSON object - call function to send to ALL players

 private function buildBulkMessage ($from, $msg) {
   $this->logs[] = array(
       "user" => $this->connectedUsersNames[$from->resourceId],
       "msg" => $msg,
       "queryresult" => $this->dbResults($msg),
       "timestamp" => time()
   );
   $this->sendBulkMessage(end($this->logs));
 }

 // send message as JSON to all socket users, based on message passed
   private function sendBulkMessage($message) {
         foreach ($this->connectedUsers as $user) {
             $user->send(json_encode($message));
         }
     }

// query database for card info, based on the id passed from JS - usually on card click
  private function dbResults($message) {
          $query = DB::table('cards')->where('card_id', $message)->first();
          return $query;
      }



}
