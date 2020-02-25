<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DateTime;
use App;

class CourseController extends Controller
{
    private $messageError='';
    private $message='';

    public function __construct()
    {
        $this->middleware('auth.session');
    }

    public function courses(){
        $courses="";
        if(request('search')){
            $search=request('search');
            $courses=App\Course::where('name','LIKE',"%{$search}%")->paginate(5);
        }else{
            $courses=App\Course::paginate(5);;
        }

        return view('courses.list_courses', compact('courses'));
    }

    public function addcourses(){
        $courses="";
        return view('courses.add_courses', compact('courses','diff'));
    }

    public function storecourses(Request $request){
        Validator::make($request->all(),$this->Rules())
                ->setAttributeNames($this->Attributes())
                ->validate();

        $addcourse = new App\Course;
        $addcourse->name = $request->name;
        $addcourse->type = $request->type;
        $addcourse->link = $request->link;
        $addcourse->place = $request->place;
        $addcourse->objective = $request->objective;
        $addcourse->content = $request->content;
        $addcourse->start_course = $request->start_course;
        $addcourse->end_course = $request->end_course;
        $addcourse->save();

        return redirect('cursos')->with('message', "El curso $request->name ha sido agregado exitosamente!");

    }

    public function Rules(){
        return [
            'name' => 'required',
            'type'=>'required',
            'objective'=>'required',
            'content'=>'required',
        ];
    }

    public function Attributes(){
        return [
            'name' => 'nombre',
            'type'=>'tipo',
            'objective'=>'objetivo',
            'content'=>'contenido'
        ];
    }
}
