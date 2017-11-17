<?php

namespace App\Http\Controllers;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Illuminate\Support\Facades\DB;

class WebSocketController implements MessageComponentInterface {

    protected $clients;
    private $logs;
    private $connectedUsers;
    private $connectedUsersNames;
    # private $query;

  public function __construct() {
      $this->clients = new \SplObjectStorage;
      $this->logs = [];
      $this->connectedUsers = [];
      $this->connectedUsersNames = [];
  }

  public function onOpen(ConnectionInterface $conn) {
      // Store the new connection to send messages to later
      $this->clients->attach($conn);

      echo "New connection! ({$conn->resourceId})\n";
      #$conn->send(json_encode($this->logs));
      $this->connectedUsers [$conn->resourceId] = $conn;
      $this->connectedUsersNames[$conn->resourceId] = $conn->resourceId;
      $conn->send(json_encode($this->connectedUsersNames));
  }

  public function onMessage(ConnectionInterface $from, $msg) {
       // Do we have a username for this user yet?
       if (isset($this->connectedUsersNames[$from->resourceId])) {
           // If we do, append to the chat logs their message

           $this->logs[] = array(
               "user" => $this->connectedUsersNames[$from->resourceId],
               "msg" => $msg,
               "queryresult" => $this->dbResults($msg),
               "timestamp" => time()
           );
           $this->sendMessage(end($this->logs));

       } else {
           // If we don't this message will be their username
           $this->connectedUsersNames[$from->resourceId] = "Unknown Player";
       }
   }

/*  public function onMessage(ConnectionInterface $from, $msg) {
      $numRecv = count($this->clients) - 1;
      echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
          , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');


      foreach ($this->clients as $client) {
          if ($from !== $client) {
              // The sender is not the receiver, send to each client connected
              $client->send($msg);
          }
      }
  }
  */

  public function onClose(ConnectionInterface $conn) {
      // The connection is closed, remove it, as we can no longer send it messages
      $this->clients->detach($conn);
      unset($this->connectedUsersNames[$conn->resourceId]);
      unset($this->connectedUsers[$conn->resourceId]);
      echo "Connection {$conn->resourceId} has disconnected\n";
  }

  public function onError(ConnectionInterface $conn, \Exception $e) {
      echo "An error has occurred: {$e->getMessage()}\n";

      $conn->close();
  }

  private function sendMessage($message) {
        foreach ($this->connectedUsers as $user) {
            $user->send(json_encode($message));
        }
    }

  private function dbResults($message) {
          $query = DB::table('cards')->where('card_id', $message)->first();
          return $query;
      }

}
