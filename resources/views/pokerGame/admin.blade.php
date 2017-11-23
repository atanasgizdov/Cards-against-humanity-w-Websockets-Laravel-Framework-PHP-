@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

<h2> Players currently in the game </h2>

<div class="cards">

</div>

@endsection

@section('js')

<script type="text/javascript" src="{{ URL::asset('js/admin.js') }}"></script>

@endsection
