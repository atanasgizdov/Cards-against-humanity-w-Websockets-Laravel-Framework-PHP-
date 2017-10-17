<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PokerGameController extends Controller
{
  public function show()
{
  return view('pokerGame/show');
}
}
