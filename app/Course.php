<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'link'
    ];
    public function competitions(){
        return $this->belongsTo(Competition::class);
    }

    public function students(){
        return $this->belongsToMany(Student::class,'student_course');
    }
}
