<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function students(){
        $student='';
         return view('students.list_students', compact('student'));
     }

    public function studentprogress(){
        $student="";
        return view('students.students_progress', compact('student'));
    }
}
