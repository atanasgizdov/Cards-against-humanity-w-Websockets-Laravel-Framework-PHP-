@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

<h2> Players currently in the game </h2>

<div class="card">
  <span style="width:100%"> Player 1 </span>
  <div class="container">
    <h4><b>John Doe</b></h4>
    <p>Architect Engineer</p>
  </div>
</div>

@endsection

@section('js')

<script type="text/javascript" src="{{ URL::asset('js/admin.js') }}"></script>

@endsection
