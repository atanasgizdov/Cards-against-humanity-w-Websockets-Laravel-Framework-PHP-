@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

<h2> Planning Poker: You are currently in game:  </h2>
<br>

<div class="cards">

</div>

<br>



@endsection

@section('js')

<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>

@endsection
