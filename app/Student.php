<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function careers(){
        return $this->belongsTo(Career::class,'career_id');
    }
}
