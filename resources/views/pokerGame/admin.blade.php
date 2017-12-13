@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

<h2> Players currently in the game </h2>

<div class="cards">

  <button type="button" class="btn btn-primary btn-sm" onclick="conn.send('{&quot;msg&quot; :1}')">
    Start game
  </button>

</div>

@endsection

@section('js')

<script type="text/javascript" src="{{ URL::asset('js/admin.js') }}"></script>

@endsection
