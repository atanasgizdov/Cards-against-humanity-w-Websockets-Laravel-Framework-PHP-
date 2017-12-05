<?php

use Illuminate\Database\Seeder;
use App\cards;
use App\cardtypes;

class cardtypesjunctionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    # First, create an array of all the books we want to associate tags with
    # The *key* will be the book title, and the *value* will be an array of tags.
    # Note: purposefully omitting the Harry Potter books to demonstrate untagged books
    $cards =[
        'Test title 1' => ['white'],
        'Test title 2' => ['white'],
        'Test title 3' => ['white'],
        'Test title 4' => ['white'],
        'Test title 5' => ['black']
    ];

    # Now loop through the above array, creating a new pivot for each book to tag
    foreach ($cards as $title => $tags) {

        # First get the book
        $card = cards::where('title', 'like', $title)->first();

        # Now loop through each tag for this book, adding the pivot
        foreach ($tags as $tagName) {
            $tag = cardtypes::where('card_type', 'LIKE', $tagName)->first();

            # Connect this tag to this book
            $card->cardtypesFK()->save($tag);
        }
    }
  }
}
