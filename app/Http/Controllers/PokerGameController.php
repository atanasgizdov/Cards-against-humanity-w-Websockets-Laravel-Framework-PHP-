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
  $session = 1234;
  include('ChatServer.php');
  return view ('pokerGame/admin');

}

public function joinGame(){
  return view ('pokerGame/admin');
}

}
