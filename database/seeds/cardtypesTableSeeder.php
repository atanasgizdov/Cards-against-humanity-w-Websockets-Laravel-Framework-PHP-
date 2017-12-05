<?php

use Illuminate\Database\Seeder;
use App\cardtypes;

class cardtypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $cardTypes = ['white', 'black'];

  foreach ($cardTypes as $type) {
      $newType = new cardtypes();
      $newType->card_type = $type;
      $newType->save();
      }
    }
}
