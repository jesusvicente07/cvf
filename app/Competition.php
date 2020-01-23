<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'name'
    ];
    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function trajectories(){
        return $this->belongsToMany(Trajectorie::class);
    }
}
