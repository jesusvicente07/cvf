<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App;

class StudentTrajectories extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth.session');
    }

    public function selecttrajectories(){
        $student = App\Student::findOrFail(Auth::guard('student')->user()->id);
        $trajectories=App\Trajectorie::all();
        return view('students.select_trajectories', compact('student','trajectories'));
    }

    public function storetrajectories(Request $request){
        Validator::make($request->all(),$this->Rules3())
                ->setAttributeNames($this->Attributes())
                ->validate();

        if(count($request->trajectories) != count(array_unique($request->trajectories))){
            return redirect('selecionar/trayectorias')->with('message', "Las trayectorias no deben repetirse!");
        }

        $student = App\Student::findOrFail(Auth::guard('student')->user()->id);
        $student->trajectories()->syncWithoutDetaching($request->trajectories);

        return redirect('trayectorias/selecionadas')->with('message', "Las trayectorias han sido agregadas exitosamente!");

    }

    public function myprogress($id){
        $student = App\Student::findOrFail(Auth::guard('student')->user()->id);
        return view('students.my_progress', compact('student'));
    }

    public function studenttrajectories(){
        $student = App\Student::findOrFail(Auth::guard('student')->user()->id);
        return view('students.students_trajectories', compact('student'));
    }
    
    public function deletestudenttrajectories($id){
        $student = App\Student::findOrFail(Auth::guard('student')->user()->id);
        $student->trajectories()->detach($id);
        return redirect('trayectorias/selecionadas')->with('message', "La trayectoria ha sido eliminada exitosamente!");
    }

    public function studentsevidences(){
        $student = App\Student::findOrFail(Auth::guard('student')->user()->id);
    }

    
    public function Rules3(){
        return [
            'trajectories'=>'required'
        ];
    }

    public function Attributes(){
        return [
            'name' => 'nombre',
            'email'=>'correo',
            'password'=>'contraseña',
            'careers'=>'carrera',
            'trajectories'=>'trayectorias '
        ];
    }
}
