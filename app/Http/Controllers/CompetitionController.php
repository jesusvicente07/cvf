<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function competitions(){
        return view('competitions.list_competitions', compact('competition'));
    }
}
