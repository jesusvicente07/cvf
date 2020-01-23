<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function careers(){
        $career="";
        return view('careers.list_careers', compact('carrer'));
    }

    public function addcareers(){
        $career="";
        return view('careers.add_careers', compact('carrer'));
    }
}
