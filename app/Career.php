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
        return $this->belongsTo(User::class,'user_id');
    }

    public function students(){
        return $this->hasOne(Student::class,'career_id','id');
    }
}
