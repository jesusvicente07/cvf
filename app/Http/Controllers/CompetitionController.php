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
            $competitions=App\Competition::search(request('search'))->paginate(5);
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

        return redirect('/nueva/competencia')->with('mensaje', "La competencia ha sido agregado exitosamente!");

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
