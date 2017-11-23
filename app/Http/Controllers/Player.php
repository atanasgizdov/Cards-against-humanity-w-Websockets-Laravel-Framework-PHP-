<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Player extends Controller
{

  private $playerId;
  private $playerCards;
  private $blackCardsWon;
  private $userName;

  public function __construct($id) {
      $this->playerId = $id;
      $this->playerCards = [];
      $this->blackCardsWon = [];

}

public function getPlayerId () {
   return $this->playerId;
}

public function getPlayerCards () {
  return $this->playerCards;
}

public function getPlayerBlackCards() {
  return $this->blackCardsWon;
}

public function getUserName () {
  return $this->userName;
}

public function updateUserName ($username) {
  $this->userName = $username;
}

}
