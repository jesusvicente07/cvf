<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App;

class TrajectorieController extends Controller
{
    private $messageError='';
    private $message='';

    public function __construct()
    {
        $this->middleware('auth.session');
    }

    public function index(){
        $trajectories="";
        if(request('search')){
            $search=request('search');
            $trajectories=App\Trajectorie::where('name','LIKE',"%{$search}%")->paginate(5);
        }else{
            $trajectories=App\Trajectorie::paginate(5);;
        }
        return view('trajectories.list_trajectories', compact('trajectories'));
    }

    public function create(){
        $competitions=App\Competition::all();
        return view('trajectories.add_trajectories', compact('competitions'));
    }

    public function store(Request $request){
        Validator::make($request->all(),$this->Rules())
                ->setAttributeNames($this->Attributes())
                ->validate();
                
        if(count($request->competitions) != count(array_unique($request->competitions))){
            return redirect('nueva/trayectoria')->with('message', "Las competencias no deben repetirse!");
        }
        $addTrajectorie = new App\Trajectorie;
        $addTrajectorie->name = $request->name;
        $addTrajectorie->save();
        $addTrajectorie->competitions()->attach($request->competitions);

        return redirect('trayectorias')->with('message', "La trayectoria $request->name ha sido agregado exitosamente!");

    }

    public function edit(App\Trajectorie $trajectorie){
        $competitions=App\Competition::all();
        return view('trajectories.edit_trajectories', compact('trajectorie','competitions'));
    }

    public function update(App\Trajectorie $trajectorie){
        $rules['name']='required';
        if(!$trajectorie->competitions){
            $rules['competitions']='required';
        }
        Validator::make(request()->all(),$rules)
        ->setAttributeNames($this->Attributes())
        ->validate();

        if(request('competitions')){
            if(count(request('competitions')) != count(array_unique(request('competitions')))){
                $this->messageError='Las competencias no deben repetirse!';                
            }else{
                $trajectorie->competitions()->syncWithoutDetaching(request('competitions'));
            }   
        }

        if(!$this->messageError){
            $trajectorie->name = request('name');
            $trajectorie->save();
            $this->message="La trayectoria  $trajectorie->name ha sido actualizado exitosamente!";

        }
        return redirect('editar/trayectoria/'.$trajectorie->id)
        ->with('message', ($this->message)? $this->message : '')
        ->with('messageError',($this->messageError)? $this->messageError : '');
    }

    public function delete($id){
        $trajectorie = App\Trajectorie::findOrFail($id);
        $nameTrajectorie = $trajectorie->name;
        $trajectorie->delete();
        return redirect('trayectorias')->with('message', "La trayectoria $nameTrajectorie ha sido eliminado exitosamente!");
    }

    public function deleteDetailTrajectorieCompetition($id){
        $trajectorie = App\Trajectorie::findOrFail($id);
        $trajectorie->competitions()->detach(request('competition_id'));
        return back();
    }

    public function Rules(){
        return [
            'name' => 'required',
            'competitions'=>'required'
        ];
    }

    public function Attributes(){
        return [
            'name' => 'nombre',
            'competitions'=>'competencias '
        ];
    }
    
}
