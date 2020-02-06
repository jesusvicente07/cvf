<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'name'
    ];
    public function trajectories(){
        return $this->belongsToMany(Trajectorie::class, 'career_trajectorie');
    }
    public function coordinators(){
        return $this->hasOne(User::class);
    }
}
