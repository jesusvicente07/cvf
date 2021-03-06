<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $guard = 'student';

    protected $fillable = [
        'name', 'email', 'password'
    ];
    
    public function careers(){
        return $this->belongsTo(Career::class,'career_id');
    }

    public function trajectories(){
        return $this->belongsToMany(Trajectorie::class,'student_trajectorie');
    }

    public function courses(){
        return $this->belongsToMany(Course::class,'student_course')->withPivot('evidence','status', 'id');
    }
}
