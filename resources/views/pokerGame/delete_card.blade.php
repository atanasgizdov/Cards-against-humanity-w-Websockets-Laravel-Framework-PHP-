@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

<h2> Delete any old cards</h2>

<br>

<div class="cards">

  <div class="black_cards">

    <div class="card simple image">
      <div class="card-image">
          <img src="https://pbs.twimg.com/profile_images/923599161940955136/KtK4rkf1.jpg" alt="">
      </div>
      <div class="card-text">
            <input type="text" name="deleteCard" id ="deleteCard" placeholder="Card ID"><br>
      </div>
  </div>

  </div>

</div>

<br>

<button type="button" class="btn btn-primary btn-sm" onclick="deleteCardJSON()">
  Save
</button>

<br>

<br>


@endsection

@section('js')

<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>

@endsection
