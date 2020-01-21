<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrajectorieController extends Controller
{
    //
    public function index(){
        $trajectories="";
        return view('trajectories.list_trajectories', compact('trajectories'));
    }

    public function create(){
        $trajectories="";
        return view('trajectories.add_trajectories');
    }
}
