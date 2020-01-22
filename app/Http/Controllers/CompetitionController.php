<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function competitions(){
        $competitions="";
        return view('competitions.list_competitions', compact('competition'));
    }

    public function addcompetitions(){
        $competitions="";
        return view('competitions.add_competitions', compact('competition'));
    }
}
