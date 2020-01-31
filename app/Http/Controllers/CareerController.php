<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App;

class CareerController extends Controller
{
    private $messageError='';
    private $message='';
    
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

        if(count($request->trajectories) != count(array_unique($request->trajectories))){
            return redirect('nueva/carrera')->with('message', "Las trayectorias no deben repetirse!");
        }

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

        if(request('trajectories')){
            if(count(request('trajectories')) != count(array_unique(request('trajectories')))){
                $this->messageError='Las trayectorias no deben repetirse!';                
            }else{
                $career->trajectories()->syncWithoutDetaching(request('trajectories'));
            }   
        }

        if(!$this->messageError){
            $career->name = request('name');
            $career->save();
            $this->message="La carrera  $career->name ha sido actualizada exitosamente!";

        }

        return redirect('editar/carrera/'.$career->id)
        ->with('message', ($this->message)? $this->message : '')
        ->with('messageError',($this->messageError)? $this->messageError : '');
    }

    public function deletecareers($id){
        $deleteCareers = App\Career::findOrFail($id);
        $namecareer = $deleteCareers->name;
        $deleteCareers->delete();

        return redirect('carreras')->with('message', "La carrera $namecareer ha sido eliminada exitosamente!");
    }

    public function deletetrajectories($id){
        $deleteTrajectories = App\Career::findOrFail($id);
        $deleteTrajectories->trajectories()->detach(request('trajectorie_id'));

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
