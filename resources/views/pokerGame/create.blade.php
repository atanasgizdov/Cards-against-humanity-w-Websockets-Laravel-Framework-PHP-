@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

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

<br>
@endsection
