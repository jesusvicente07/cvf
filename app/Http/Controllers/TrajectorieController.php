<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App;

class TrajectorieController extends Controller
{
    public function index(){
        $trajectories="";
        if(request('search')){
            $search=request('search');
            $trajectories=App\Trajectorie::where('name','LIKE',"%{$search}%")->paginate(5);
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
        Validator::make($request->all(),$this->Rules())
                ->setAttributeNames($this->Attributes())
                ->validate();
        $addTrajectorie = new App\Trajectorie;
        $addTrajectorie->name = $request->name;
        $addTrajectorie->save();
        $addTrajectorie->competitions()->attach($request->competitions);

        return redirect('trayectorias')->with('message', "La trayectoria ha sido agregado exitosamente!");

    }

    public function delete($id){
        $trajectorie = App\Trajectorie::findOrFail($id);
        $nameTrajectorie = $trajectorie->email;
        $trajectorie->delete();
        return redirect('trayectorias')->with('message', "La trayectoria $nameTrajectorie ha sido eliminado exitosamente!");
    }

    public function Rules(){
        return [
            'name' => 'required|unique:trajectories',
            'competitions'=>'required'
        ];
    }

    public function Attributes(){
        return [
            'name' => 'nombre',
            'competitions'=>'competencias '
        ];
    }
    
}
