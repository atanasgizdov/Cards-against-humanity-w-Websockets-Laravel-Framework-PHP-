<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('player_id');
            $table->timestamps();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('nickname');
            $table->integer('cards_in_hand');
            $table->integer('cards_played');
            $table->integer('black_cards_won');
            #$table->foreign('cards_in_hand')->references('card_id')->on('cards');
            #$table->foreign('cards_played')->references('card_id')->on('cards');
            #$table->foreign('black_cards_won')->references('card_id')->on('cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
