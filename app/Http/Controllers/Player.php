<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Player extends Controller
{

  private $playerId;
  private $playerCards = [];
  private $blackCardsWon = [];
  private $userName;

  public function __construct($id) {
      $this->playerId = $id;
      $this->generateRandomCards();
      $this->blackCardsWon = [];

}

public function getPlayerId () {
   return $this->playerId;
}

public function getPlayerCards () {
  return $this->playerCards;
}

private function generateRandomCards () {
    $randomCards = DB::table('cards')->where('card_type', 'white')->inRandomOrder()->limit(5)->get();
       foreach ($randomCards as $card) {
         array_push($this->playerCards, $card);
       }
}

public function addRandomCardToHand () {

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
