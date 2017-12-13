<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('cards');

        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title')->default("N/A");
            $table->string('text');
            $table->bigInteger('times_played_lifetime')->default(0);
            $table->bigInteger('times_voted_for_lifetime')->default(0);
            $table->integer('active')->default(1);
            $table->integer('custom_card')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
