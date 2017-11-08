<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game', function (Blueprint $table) {
            $table->increments('game_id');
            $table->timestamps();

            $table->boolean('active');
            $table->integer('number_of_players');
            #$table->foreign('players')->references('player_id')->on('players');
            #$table->foreign('cards_played')->references('card_id')->on('cards');
            #$table->foreign('cards_in_hand')->references('card_id')->on('cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game');
    }
}
