<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function coordinators(){
        return view('coordinators.list_coordinators', compact('coordinators'));
    }

    public function addcoordinators(){
        return view('coordinators.add_coordinators', compact('coordinators'));
    }
}
