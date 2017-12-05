<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cardtypes extends Model
{
  public function cardsFK()
{
  # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
  return $this->belongsToMany('App\cards')->withTimestamps();
}
}
