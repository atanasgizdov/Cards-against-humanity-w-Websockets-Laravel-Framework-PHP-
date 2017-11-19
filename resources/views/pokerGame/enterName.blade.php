@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

<h2> Please enter you name to join the game  </h2>
<br>

<form method='POST' action='join'>
      {{ csrf_field() }}

        <br>
        <input type='text' name='playername' id='playername'>
        <input type='submit' value='Join Game'>
</form>



@endsection

@section('js')

<script>

</script>

@endsection
