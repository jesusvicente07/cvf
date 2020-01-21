<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trajectorie extends Model
{
    //
    public function competitions(){
        return $this->belongsToMany(Competition::class)
    }
}
