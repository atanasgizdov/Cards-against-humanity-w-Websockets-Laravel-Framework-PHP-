@extends('master')


@section('title')
    Atanas CAH Game
@endsection

@section('content')
<div class="jumbotron">
  <h1 class="display-3">Atanas CAH Game</h1>
  <p class="lead">All the fun of Card games, but created by you!</p>
  <p><a class="btn btn-lg btn-success" href="create" role="button">Join the Game</a></p>
  <p><a href="create_card" >Create a card</p>
  <p><a href="delete_card" >Delete existing cards</p>
  <p><a href="play" >Start the game server</p>
</div>
@endsection
