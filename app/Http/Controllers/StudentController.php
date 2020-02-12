<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App;

class StudentController extends Controller
{
    private $messageError='';
    private $message='';

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function students(){
        $students="";
        if(request('search')){
            $search=request('search');
            $students=App\Student::where('name','LIKE',"%{$search}%")->paginate(5);
        }else{
            $students=App\Student::paginate(5);;
        }
         return view('students.list_students', compact('students'));
     }

    public function studentprogress(){
        $students="";
        return view('students.students_progress', compact('students'));
    }

    public function addstudents(){
        $students="";
        $careers=App\Career::all();
        return view('students.add_students', compact('students','careers'));
    }

    public function store(Request $request){
        Validator::make($request->all(),$this->Rules())
                ->setAttributeNames($this->Attributes())
                ->validate();

        $addstudents = new App\Student;
        $addstudents->name = $request->name;
        $addstudents->email = $request->email;
        $addstudents->password = Hash::make($request->password);
        $career = App\Career::FindOrFail($request->careers);
        $addstudents->career_id=$career->id;
        $addstudents->save();

        return redirect('estudiantes')->with('message', "El estudiante $request->name ha sido agregado exitosamente!");

    }

    public function editstudents(App\Student $student){
        $careers=App\Career::all();
        return view('students.edit_students', compact('student','careers'));
    }

    public function updatestudents(App\Student $student){

        Validator::make(request()->all(),$this->Rules2())
        ->setAttributeNames($this->Attributes())
        ->validate();

        $student->name=request('name');
        $student->email=request('email');
        $student->password=request('password') ?  Hash::make(request('password')) : $student->password;
        $career = App\Career::FindOrFail(request('careers'));
        $student->career_id=$career->id;
        $student->save();

        return redirect('editar/estudiante/'.$student->id)->with('message', "El estudiante $student->name ha sido actualizado exitosamente!");

    }

    public function deletestudents($id){
        $student = App\Student::findOrFail($id);
        $nameStudent = $student->name;
        $student->delete();
        return redirect('estudiantes')->with('message', "El estudiante $nameStudent ha sido eliminado exitosamente!");
    }

    public function studenttrajectories(){
        $students="";
        return view('students.students_trajectories', compact('students'));
    }

    public function selecttrajectories(){
        $students="";
        return view('students.select_trajectories', compact('students'));
    }

    public function Rules(){
        return [
            'name' => 'required',
            'email'=>'required',
            'password'=>'required',
            'careers'=>'required',
        ];
    }

    public function Rules2(){
        return [
            'name' => 'required',
            'email'=>'required',
            'careers'=>'required',
        ];
    }

    public function Attributes(){
        return [
            'name' => 'nombre',
            'email'=>'correo',
            'password'=>'contraseña',
            'careers'=>'carrera'
        ];
    }
}
