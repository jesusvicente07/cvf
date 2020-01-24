<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trajectorie extends Model
{
    protected $fillable = [
        'name'
    ];
    public function competitions(){
        return $this->belongsToMany(Competition::class,'trajectorie_competition');
    }

    public function careers(){
        return $this->belongsToMany(Career::class,'career_trajectorie');
    }
}
