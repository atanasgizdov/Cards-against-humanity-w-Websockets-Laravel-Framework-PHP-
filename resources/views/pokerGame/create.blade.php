@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

<form method='POST' action='play'>
      {{ csrf_field() }}

        <label for='title'>Name of your Game</label>
        <br>
        <input type='text' name='title' id='title'>
        <input type='submit' value='Start your Game'>
</form>

<form method='POST' action='enterName'>
      {{ csrf_field() }}

        <br>
        <input type='submit' value='Join Game'>
</form>

<form method='POST' action='admin'>
      {{ csrf_field() }}

        <br>
        <input type='submit' value='Go to Admin Screen'>
</form>

@endsection
