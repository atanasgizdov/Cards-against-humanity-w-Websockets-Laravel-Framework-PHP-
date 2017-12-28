<?php

namespace App\Http\Controllers;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PlayerClass;
use Psy\CodeCleaner\PassableByReferencePass;

class WebSocketController implements MessageComponentInterface {

    protected $clients;
    private $logs;
    private $connectedUsers;
    private $connectedUsersNames;
    private $connectedUsersObjects;
    private $whoseTurn;
    private $whoHasTakenTheirTurn;

  public function __construct() {
      $this->clients = new \SplObjectStorage;
      $this->logs = [];
      $this->connectedUsers = [];
      $this->connectedUsersNames = [];
      $this->connectedUsersObjects = [];
      $this->whoHasTakenTheirTurn = [];
  }

  //TODO add an array to track cards already played so it doens't return the same ones when user draws

  //TODO expand interface to feature multiple rooms and id's

  /*

 Dictionary for requests and their responses
 ******************************************************************************

 */


  /*

 Socket Methods - do something onOpen, onMessage and onClose
 ******************************************************************************

 */

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
      //$conn->send(json_encode($this->connectedUsersNames));
  }

  public function onMessage(ConnectionInterface $from, $msg) {
       // Do we have a username for this user yet? New players won't so first message received sets this
       if (isset($this->connectedUsersNames[$from->resourceId])) {
           // If we do, build JSON based on request
           dump($msg);

           try {
             $msg = json_decode($msg);
             dump($msg);

               // receieve msg code 1 - request for list of current players - this is based on current objects
               if ($msg->msg == 1){
                 $this->sendListOfPlayers($from);
               }
                // show all player white cards
               if ($msg->msg == 2) {
                  $this->sendListOfWhiteCards($from);
               }
               //admin clicks start game
               if ($msg->msg == 3) {
                   $this->progressGame();
                   $this->sendWhoseTurn();
                   $this->sendBlackCard ($from);
               }
              // user who just went wants next turn
               if ($msg->msg == 4) {
                  sendWhoseTurn();
                  sendBlackCard ();
               }


               /*
                // delete Card

               if ($msg->msg == x) {
                   $this->deleteCard($msg->cardID);
               }

               // create a card with the selected inputs
               if ($msg->msg == x) {
                    $this->createCard($msg->cardText);
               }
               */



            }

           catch (Exception $e) {
             dump("There was an error parsing the JSON passed");
 }


           //$this->buildBulkMessage($from, $msg);
           //$this->buildSingleMessage($from, $msg);


       } else {
           // If we don't this message will be their username - update connectedUsersNames array
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

  /*

 Game Loop - create the game loop and logic
 ******************************************************************************

 */

 private function progressGame () {
    $playerSelected = false;
    $whoseTurn = array_rand($this->connectedUsers);
    dump($whoseTurn);

    while ($playerSelected == false) {
      if (count($this->whoHasTakenTheirTurn) == count ($this->connectedUsers)){
          $this->whoHasTakenTheirTurn = [];
        }
      if (in_array($whoseTurn, $this->whoHasTakenTheirTurn)) {
          $whoseTurn = array_rand($this->connectedUsers);
       }
      else {
         $this->whoseTurn = $whoseTurn;
         array_push($this->whoHasTakenTheirTurn, $whoseTurn);
         dump($this->whoseTurn);
         dump($this->whoHasTakenTheirTurn);
         $playerSelected = true;

          }
    }

 }

  /*

 Messenger methods - build messages for single recepient or send to all players
 ******************************************************************************

 */
// based on message passed and from whom, build a generic message to return as a JSON object - call function to send to single player

private function buildSingleMessage ($from, $msg) {
  $this->logs[] = array(
      "user" => $this->connectedUsersNames[$from->resourceId],
      "msg" => $msg,
      "timestamp" => time()
  );
  $this->sendSingleMessage($from, end($this->logs));
}

// send message as JSON to just user who sent it, based on message passed
  private function sendSingleMessage($from, $message) {
     foreach ($this->connectedUsers as $user) {
        if ($from->resourceId == $user->resourceId) {
             $user->send(json_encode($message));
        }
     }
}
 // based on message passed and from whom, build a generic message to return as a JSON object - call function to send to ALL players

 private function buildBulkMessage ($from, $msg) {
   $this->logs[] = array(
       "user" => $this->connectedUsersNames[$from->resourceId],
       "msg" => $msg,
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

 /*

Player methods - manipulate and send Player objects
******************************************************************************

*/

  // send list of current players

  private function sendListOfPlayers ($from) {
    $this->logs[] = array(
        "response_code" => "1",
        "msg" => $this->connectedUsersNames
    );

    $this->sendBulkMessage(end($this->logs));
  }

  private function sendWhoseTurn () {
    $this->logs[] = array(
        "response_code" => "4",
        "msg" => $this->whoseTurn
    );

    $this->sendBulkMessage(end($this->logs));
  }


  /*

 Card methods - manipulate and send card objects
 ******************************************************************************

 */

  // send the list of cards currently in the player's hand as JSON

  private function sendListOfWhiteCards ($from) {
    $playerCards;
    foreach ($this->connectedUsersObjects as $user) {
        if ($user->getPlayerId() == $from->resourceId ) {
            $playerCards = $user->getPlayerWhiteCards();
        }
    }

    $this->logs[] = array(
        "response_code" => "2",
        "msg" => $playerCards
    );
    $this->sendSingleMessage($from, end($this->logs));
  }

  private function sendBlackCard () {
    $playerCards;
    foreach ($this->connectedUsersObjects as $user) {
        if ($user->getPlayerId() == $this->whoseTurn ) {
            $playerCards = $user->getPlayerCurrentBlackCard();
        }
    }

    $this->logs[] = array(
        "response_code" => "3",
        "msg" => $playerCards
    );

    foreach ($this->connectedUsers as $user) {
        if ($whoseTurn == $user->resourceId) {
            $from = $user;
        }
    $this->sendSingleMessage($from, end($this->logs));
  }
}


  // create a card record in DB

  private function createCard ($cardText) {
      $id = DB::table('cards')->insertGetId(
          ['created_at' => date("Y/m/d"),
           'text' => $cardText,
           'active' => 1,
           'custom_card' => 1]
);
  }

  // mark a card record as inactive

  private function deleteCard ($cardID) {
      dump($cardID);
      DB::table('cards')->where('id', $cardID)->update(['active' => 0]);
  }



}
