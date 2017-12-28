<?php

use Illuminate\Database\Seeder;
use App\cards;

class cardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      # Array of cards data to add
  $cards = [
      ['Test title 1', 'test body 1', 0, 0, 1, 1],
      ['Test title 2', 'test body 2', 0, 0, 1, 1],
      ['Test title 3', 'test body 3', 0, 0, 1, 1],
      ['Test title 4', 'test body 4', 0, 0, 1, 1],
      ['Test title 5', 'test body 5', 0, 0, 1, 1],
      ['Test title 1-Black', 'test body 1', 0, 0, 1, 1],
      ['Test title 2-Black', 'test body 2', 0, 0, 1, 1],
      ['Test title 3-Black', 'test body 3', 0, 0, 1, 1],
      ['Test title 4-Black', 'test body 4', 0, 0, 1, 1],
      ['Test title 5-Black', 'test body 5', 0, 0, 1, 1]
  ];

  $count = count($cards);

  # Loop through each author, adding them to the database
  foreach ($cards as $card) {
      cards::insert([
          'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
          'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
          'title' => $card[0],
          'text' => $card[1],
          'times_played_lifetime' => $card[2],
          'times_voted_for_lifetime' => $card[3],
          'active' => $card[4],
          'custom_card' => $card[5]
      ]);
      $count--;
      }
    }
}
