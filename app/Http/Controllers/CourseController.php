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
        return view('courses.add_courses', compact('courses'));
    }

    public function storecourses(Request $request){
        Validator::make($request->all(),$this->Rules())
                ->setAttributeNames($this->Attributes())
                ->validate();

        $addcourse = new App\Course;
        $addcourse->name = $request->name;
        $addcourse->type = $request->type;
        $addcourse->link = $request->link;
        $addcourse->objective = $request->objective;
        $addcourse->content = $request->content;
        $addcourse->duration = $request->duration;
        $addcourse->save();

        return redirect('cursos')->with('message', "El curso $request->name ha sido agregado exitosamente!");

    }

    public function editcourses(App\Course  $course){
        return view('courses.edit_courses', compact('course'));
    }

    public function updatecourses(App\Course  $course){
        Validator::make(request()->all(),$this->Rules())
        ->setAttributeNames($this->Attributes())
        ->validate();

        $course->name = request('name');
        $course->type = request('type');
        $course->link = request('type')=='virtual'? request('link') : '';
        $course->objective = request('objective');
        $course->content = request('content');
        $course->duration = request('type')=='virtual'? request('duration') : '';
        $course->save();

        return redirect('editar/curso/'.$course->id)->with('message', "El curso $course->name ha sido actualizado exitosamente!");
    }

    public function deletecourses($id){
        $deleteCourses = App\Course::findOrFail($id);
        $namecourse = $deleteCourses->name;
        $deleteCourses->delete();

        return redirect('cursos')->with('message', "El curso $namecourse ha sido eliminado exitosamente!");
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
