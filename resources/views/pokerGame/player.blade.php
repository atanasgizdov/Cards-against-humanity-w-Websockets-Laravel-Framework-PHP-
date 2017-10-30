@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

<h2> Players currently in the game </h2>

<div class="card">
  <span style="width:100%"> Player 1 </span>
  <div class="container" id = "firstcard" onclick="markCardAsSelected()">
    <h4><b>John Doe</b></h4>
    <p>Architect &amp Engineer</p>
  </div>
</div>


@endsection

@section('js')

<script>
  var conn = new WebSocket('ws://localhost:8080');
  conn.onopen = function(e) {
  console.log("Connection established!");
};
</script>

@endsection
