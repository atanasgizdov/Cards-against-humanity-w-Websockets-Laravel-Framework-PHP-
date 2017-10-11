<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PokerGameController extends Controller
{
  public static function startGame()
  {
    return 'Starting game...';
  }

  public static function endGame()
  {
    return 'Ending game...';
  }
}
