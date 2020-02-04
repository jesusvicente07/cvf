<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function coordinators(){
        $coordinators="";
        return view('coordinators.list_coordinators', compact('coordinators'));
    }

    public function addcoordinators(){
        $coordinators="";
        return view('coordinators.add_coordinators', compact('coordinators'));
    }

    public function editcoordinators(){
        $coordinators="";
        return view('coordinators.edit_coordinators', compact('coordinators'));
    }
}
