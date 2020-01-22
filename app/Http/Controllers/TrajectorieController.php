<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class TrajectorieController extends Controller
{
    //
    public function index(){
        $trajectories="";
        if(request('search')){
            $trajectories=App\Trajectorie::search(request('search'))->paginate(5);
        }else{
            $trajectories=App\Trajectorie::paginate(5);;
        }

        return view('trajectories.list_trajectories', compact('trajectories'));
    }

    public function create(){
        $competitions=App\Competition::all();
        return view('trajectories.add_trajectories', compact('competitions'));
    }

    public function store(Request $request){
        var_dump($request->all());
        exit;
        $request->validate([
            'name' => 'required|unique:trajectories',
            'competitions'=>'required|exists:competitions'
        ]);
        $addTrajectorie = new Trajectorie;
        $addTrajectorie->name = $request->name;
        $addTrajectorie->save();
        $addTrajectorie->competitions()->attach($request->competitions);

        return redirect('trayectorias')->with('mensaje', "La trayectoria ha sido agregado exitosamente!");

    }
}
