<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App;

class CompetitionController extends Controller
{
    private $messageError='';
    private $message='';

    public function __construct()
    {
        $this->middleware('auth.session');
    }
    
    public function competitions(){
        $competitions="";
        if(request('search')){
            $search=request('search');
            $competitions=App\Competition::where('name','LIKE',"%{$search}%")->paginate(5);
        }else{
            $competitions=App\Competition::paginate(5);;
        }

        return view('competitions.list_competitions', compact('competitions'));
    }

    public function addcompetitions(){
        $competitions="";
        $courses=App\Course::all();
        return view('competitions.add_competitions', compact('competitions','courses'));
    }

    public function store(Request $request){
        Validator::make($request->all(),$this->Rules())
        ->setAttributeNames($this->Attributes())
        ->validate();

        if(count($request->courses) != count(array_unique($request->courses))){
            return redirect('nueva/competencia')->with('message', "Los cursos no deben repetirse!");
        }
      
        $addCompetition = new App\Competition;
        $addCompetition->name = $request->name;
        $addCompetition->save();
        $addCompetition->courses()->attach($request->courses);

        return redirect('competencias')->with('message', "La competencia $request->name ha sido agregada exitosamente!");

    }

    public function editcompetitions(App\Competition  $competition){
        $courses=App\Course::all();
        return view('competitions.edit_competitions', compact('competition','courses'));
    }

    public function update(App\Competition  $competition){
        $rules['name']='required';
        if(!$competition->courses){
            $rules['courses']='required';
        }
        Validator::make(request()->all(), $rules)
        ->setAttributeNames($this->Attributes())
        ->validate();

        if(request('courses')){
            if(count(request('courses')) != count(array_unique(request('courses')))){
                $this->messageError='Los cursos no deben repetirse!';                
            }else{
                $competition->courses()->syncWithoutDetaching(request('courses'));
            }   
        }

        if(!$this->messageError){
            $competition->name = request('name');
            $competition->save();
            $this->message="La competencia $competition->name ha sido actualizada exitosamente!";

        }

        return redirect('editar/competencia/'.$competition->id)
        ->with('message', ($this->message)? $this->message : '')
        ->with('messageError',($this->messageError)? $this->messageError : '');
    }

    public function deletecompetitions($id){
        $deleteCompetition = App\Competition::findOrFail($id);
        $namecompetition = $deleteCompetition->name;
        $deleteCompetition->delete();

        return redirect('competencias')->with('message', "La competencia $namecompetition ha sido eliminada exitosamente!");
    }

    public function deletecompetitionsC($id){
        $deleteCourses = App\Competition::findOrFail($id);
        $deleteCourses->courses()->detach(request('course_id'));

        return back();
    }

    public function Rules(){
        return [
            'name' => 'required',
            'courses'=>'required'
        ];
    }

    public function Attributes(){
        return [
            'name' => 'nombre',
            'courses'=>'cursos '
        ];
    }
}
