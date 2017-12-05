<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cards extends Model
{
  public function cardtypesFK() {
  return $this->belongsToMany('App\cardtypes')->withTimestamps();
}
}
