<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App;

class CareerController extends Controller
{
    public function careers(){
        $careers="";
        $careers=App\Career::all();
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

        return redirect('carreras')->with('message', "La carrera $request->name ha sido agregado exitosamente!");

    }

    public function deletecareers($id){
        $deleteCareers = App\Career::findOrFail($id);
        $namecareer = $deleteCareers->name;
        $deleteCareers->delete();

        return redirect('carreras')->with('message', "La carrera $namecareer ha sido eliminada exitosamente!");
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
