<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PokerGameController extends Controller
{
  public function show()
{
  return view('pokerGame/show');
}

public function createGameView(){

  return view ('pokerGame/create');
}

public function createCard(){

  return view ('pokerGame/create_card');
}

public function deleteCard(){

  return view ('pokerGame/delete_card');
}

public function startGame(){

  include('ChatServer.php');

}

public function enterName(){
  return view ('pokerGame/enterName');
}

public function joinGame(){
  return view ('pokerGame/player');
}

public function admin(){
  return view ('pokerGame/admin');
}

}
