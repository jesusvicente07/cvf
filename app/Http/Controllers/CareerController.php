<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App;

class CareerController extends Controller
{
    public function careers(){
        $careers="";
        if(request('search')){
            $search=request('search');
            $career=App\Career::where('name','LIKE',"%{$search}%")->paginate(5);
        }else{
            $careers=App\Career::paginate(5);;
        }
        return view('careers.list_careers', compact('careers'));
    }

    public function addcareers(){
        $careers="";
        $trajectories=App\Trajectorie::all();
        return view('careers.add_careers', compact('careers', 'trajectories'));
    }

    public function store(Request $request){
        Validator::make($request->all(),$this->Rules())
                ->setAttributeNames($this->Attributes())
                ->validate();
        $addcareer = new App\Career;
        $addcareer->name = $request->name;
        $addcareer->save();
        $addcareer->trajectories()->attach($request->trajectories);

        return redirect('carreras')->with('message', "La carrera ha sido agregado exitosamente!");

    }

    public function Rules(){
        return [
            'name' => 'required|unique:careers',
            'trajectories'=>'required'
        ];
    }

    public function Attributes(){
        return [
            'name' => 'nombre',
            'trajectories'=>'trayectorias '
        ];
    }
    
}
