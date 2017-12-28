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
  private $currentBlackCard = [];

  public function __construct($id) {
      $this->playerId = $id;
      $this->generateRandomCards();
      $this->getABlackCardFromDeck();

}

// object manipulators

public function getPlayerId () {
   return $this->playerId;
}

public function getUserName () {
  return $this->userName;
}

public function updateUserName ($username) {
  $this->userName = $username;
}

// card manipulators

public function getPlayerWhiteCards () {
  return $this->playerCards;
}

public function getPlayerCurrentBlackCard () {
  return $this->$currentBlackCard;

}

public function getABlackCardFromDeck () {
  $blackCard = DB::table('cards')
            ->join('cards_cardtypes', 'cards.id', '=', 'cards_cardtypes.cards_id')
            ->join('cardtypes', 'cardtypes.id', '=', 'cards_cardtypes.cardtypes_id')
            ->select('cards_id','title', 'text' , 'active', 'custom_card')
            ->where('cardtypes_id', '2')
            ->inRandomOrder()
            ->limit(1)
            ->get();

         array_push($this->currentBlackCard, $blackCard);

}


public function getPlayerBlackCardsWon() {
  return $this->blackCardsWon;
}

public function addRandomCardToHand () {

}

// db interactions & private methods

private function generateRandomCards () {
  $randomCards = DB::table('cards')
            ->join('cards_cardtypes', 'cards.id', '=', 'cards_cardtypes.cards_id')
            ->join('cardtypes', 'cardtypes.id', '=', 'cards_cardtypes.cardtypes_id')
            ->select('cards_id','title', 'text' , 'active', 'custom_card')
            ->where('cardtypes_id', '1')
            ->inRandomOrder()
            ->limit(5)
            ->get();
       foreach ($randomCards as $card) {
         array_push($this->playerCards, $card);
       }
}

public function practice()
{

}

}
