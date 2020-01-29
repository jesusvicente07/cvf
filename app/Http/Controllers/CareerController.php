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

    public function editcareers(App\Career  $career){
        $trajectories=App\Trajectorie::all();
        return view('careers.edit_careers', compact('career', 'trajectories'));
    }

    public function update(App\Career  $career){
        $rules['name']='required';
        if(!$career->trajectories){
            $rules['trajectories']='required';
        }
        Validator::make(request()->all(), $rules)
        ->setAttributeNames($this->Attributes())
        ->validate();
        $career->name = request('name');
        $career->save();
        if(request('trajectories')){
            $career->trajectories()->attach(request('trajectories'));
        }
        return redirect('editar/carrera/'.$career->id)->with('message', "La carrra $career->name ha sido actualizada exitosamente!");
    }

    public function deletecareers($id){
        $deleteCareers = App\Career::findOrFail($id);
        $namecareer = $deleteCareers->name;
        $deleteCareers->delete();

        return redirect('carreras')->with('message', "La carrera $namecareer ha sido eliminada exitosamente!");
    }

    public function deletetrajectories($id){
        $deleteTrajectories = App\Trajectorie::findOrFail($id);
        $deleteTrajectories->careers()->detach();

        return back();
    }


    public function Rules(){
        return [
            'name' => 'required',
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
