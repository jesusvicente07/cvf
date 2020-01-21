<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    //
    public function trajectories(){
        return $this->belongsToMany(Trajectorie::class)
    }
}
