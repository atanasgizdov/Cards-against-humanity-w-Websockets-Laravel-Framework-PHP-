@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

<form method='POST' action='../public/play/'>
      {{ csrf_field() }}

        <label for='title'>Name of your Game</label>
        <br>
        <input type='text' name='title' id='title'>
        <input type='submit' value='Start your Game'>
</form>

@endsection
