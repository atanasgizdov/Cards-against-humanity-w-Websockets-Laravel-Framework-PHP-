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

public function startGame(Request $request){

  $title = $request->input('title');
  // To be used when first firing up the Web Server. Once it's spinning, this can be commented out
  include('ChatServer.php');
  return view ('pokerGame/admin');

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
