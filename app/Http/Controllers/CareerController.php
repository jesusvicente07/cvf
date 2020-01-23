<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class CareerController extends Controller
{
    public function careers(){
        $career="";
        return view('careers.list_careers', compact('carrer'));
    }

    public function addcareers(){
        $career="";
        $trajectories=App\Trajectorie::all();
        return view('careers.add_careers', compact('carrer', 'trajectories'));
    }
}
