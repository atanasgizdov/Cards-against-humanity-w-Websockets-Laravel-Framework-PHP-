<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(cardsTableSeeder::class);
      $this->call(cardtypesTableSeeder::class);
      $this->call(cardtypesjunctionTableSeeder::class);
      $this->call(gameTableSeeder::class);
    }
}
