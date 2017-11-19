@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

<h2> Planning Poker: You are currently in game:  </h2>
<br>

<div class="table">

  <div class="card" onclick="markCardAsSelected(0)">
    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width:100%">
    <div class="container">
      <h4><b>Vote 1</b></h4>
      <p>1 day of work</p>
    </div>
  </div>

  <br>

  <div class="card" onclick="markCardAsSelected(1)">
    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width:100%">
    <div class="container">
      <h4><b>Vote 2</b></h4>
      <p>2 days of work</p>
    </div>
  </div>

  <br>

  <div class="card" onclick="markCardAsSelected(2)">
    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width:100%">
    <div class="container">
      <h4><b>Vote 3</b></h4>
      <p>3 days of work</p>
    </div>
  </div>

  <br>

  <div class="card" onclick="markCardAsSelected(3)">
    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width:100%">
    <div class="container">
      <h4><b>Vote 5</b></h4>
      <p>A week of work</p>
    </div>
  </div>

  <br>

  <div class="card" onclick="markCardAsSelected(4)">
    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width:100%">
    <div class="container">
      <h4><b>Vote 8</b></h4>
      <p>1.5 weeks of work</p>
    </div>
  </div>

  <br>

</div>

<br>



@endsection

@section('js')

<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>

@endsection
