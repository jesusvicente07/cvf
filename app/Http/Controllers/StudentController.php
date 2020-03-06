<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
=======
>>>>>>> 8c00ba284fa982007a89603dc4af6156047dce3c
use Illuminate\Support\Facades\DB;
use App;

class StudentController extends Controller
{
    private $messageError='';
    private $message='';

    public function __construct(){
        $this->middleware('auth.session');
    }
    
    public function students(){
        $students="";
        $user = App\User::findOrFail(Auth::user()->id);
       /* $array_name=array();
        foreach($user->careers as $career){
            $array_name[]=$career->name;

        }
        $career_string=implode("','",$array_name); //ensure quoted values
        dd($career_string);
        //$career_id=isset($user->careers->id) ? $user->careers->id : '';*/

        if(request('search')){
            $search=request('search');
            $query='';
            switch(request('filter')){
                case 'trajectorie':
                    $query='t.name';
                break;
                case 'student': 
                    $query='students.name';
                break;
                default:
                    $query='students.name';
            }
            $students=App\Student::join('student_trajectorie as st', 'st.student_id', '=', 'students.id')
            ->join('trajectories as t', 't.id', '=', 'st.trajectorie_id')
            ->select('students.*')->where($query,'LIKE',"%{$search}%")->paginate(5);
        }else{
            $students=App\Student::join('student_trajectorie as st', 'st.student_id', '=', 'students.id')
            ->join('trajectories as t', 't.id', '=', 'st.trajectorie_id')
            ->select('students.*')->paginate(5);        
        }
        
        return view('students.list_students', compact('students'));
     }

    public function studentprogress($id){
        $file = '';
        $student = App\Student::findOrFail($id);
        return view('students.students_progress', compact('student','file'));
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

    public function downloadevidence($idS,$idC){
        $evidence=DB::table('student_course')->where('student_id', '=', $idS)->where('course_id', '=', $idC)->get();
        if(DB::table('student_course')->where('student_id', '=', $idS)->where('course_id', '=', $idC)->exists()){
            foreach($evidence as $e){
                return Storage::download($e->evidence);
            }
        }
        else{
            return back()->with('message', "No existe ningún archivo!");;
        }
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
