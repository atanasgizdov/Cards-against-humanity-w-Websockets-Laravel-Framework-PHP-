@extends('master')


@section('title')
    Atanas Planning Poker
@endsection

@section('content')

<!-- Modal -->
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title" id="myModalLabel">Please enter your name</h4>
        <span>
      </div>
      <div class="modal-body">
      <input type="text" id="user_name_ui" name="user_name_ui" maxlength="15">
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="sendUserName()">Save</button>
      </div>
    </div>
  </div>
</div>

<h2> Welcome to the game <span id = "user_name_ui_show"> </span></h2>
<br>

<button type="button" id = "draw_white_cards" class="btn btn-primary btn-sm" onclick="conn.send('{&quot;msg&quot; :3}')">
  Start the Game
</button>

<button type="button" id = "draw_white_cards" class="btn btn-primary btn-sm" onclick="conn.send('{&quot;msg&quot; :2}')">
  Draw my White Cards
</button>



<br>
<br>

<div class="current_players">

</div>

<br>

<div class="black_cards">

</div>

<br>

<div class="cards">

</div>

<br>



@endsection

@section('js')

<script type="text/javascript" src="{{ URL::asset('js/admin.js') }}"></script>

@endsection
