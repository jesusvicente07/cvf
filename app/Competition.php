<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'name'
    ];
    public function courses(){
        return $this->belongsToMany(Course::class,'competition_course');
    }

    public function trajectories(){
        return $this->belongsToMany(Trajectorie::class);
    }
}
