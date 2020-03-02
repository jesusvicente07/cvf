<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
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

    public function studentsevidences(Request $request){
        $student = App\Student::findOrFail(Auth::guard('student')->user()->id);        
        $file = $request->file('file');
        if($file){
            Validator::make($request->all(),$this->Rules4())
            ->validate();
            $filename = 'std.'.$student->id.'_'.uniqid().'_'.$file->getClientOriginalName();
            //$path = public_path();
            //$file->move($path, $filename);
            //Storage::disk('local')->put($filename,$file);
            Storage::putFileAs('uploads/students/'.$student->id,$file,$filename);
            $student->courses()->attach($request->courses,['evidence' => 'uploads/students/'.$student->id.'/'.$filename]);
            return response($file, 200)->header('Content-Type', 'application/json');

        }
        return response('error', 200)->header('Content-Type', 'application/json');


    }

    
    public function Rules3(){
        return [
            'trajectories'=>'required'
        ];
    }
    public function Rules4(){
        return [
            'file' => 'required|mimes:jpeg,jpg,png,pdf'
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
