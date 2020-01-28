<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App;

class CompetitionController extends Controller
{
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
        $competitions=App\Competition::all();
        return view('competitions.add_competitions', compact('competitions'));
    }

    public function store(Request $request){
        Validator::make($request->all(),$this->Rules())
        ->setAttributeNames($this->Attributes())
        ->validate();
      
        $addCompetition = new App\Competition;
        $addCompetition->name = $request->name;
        $addCompetition->save();
        $addCompetition->courses()->createMany($request->courses);

        return redirect('competencias')->with('message', "La competencia $request->name ha sido agregada exitosamente!");

    }

    public function deletecompetitions($id){
        $deleteCompetition = App\Competition::findOrFail($id);
        $namecompetition = $deleteCompetition->name;
        $deleteCompetition->delete();

        return redirect('competencias')->with('message', "La competencia $namecompetition ha sido eliminada exitosamente!");
    }

    public function Rules(){
        return [
            'name' => 'required|unique:competitions',
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
