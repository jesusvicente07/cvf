<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App;

class CoordinatorController extends Controller
{
    private $messageError='';
    private $message='';

    public function coordinators(){
        $coordinators="";
        if(request('search')){
            $search=request('search');
            $coordinators=App\User::where('name','LIKE',"%{$search}%")->paginate(5);
        }else{
            $coordinators=App\User::paginate(5);;
        }
        dd($coordinators[0]->careers()->name);
        return view('coordinators.list_coordinators', compact('coordinators','careers'));
    }

    public function addcoordinators(){
        $coordinators="";
        $careers=App\Career::all();
        return view('coordinators.add_coordinators', compact('coordinators','careers'));
    }

    public function store(Request $request){
        Validator::make($request->all(),$this->Rules())
                ->setAttributeNames($this->Attributes())
                ->validate();

        $addcoordinator = new App\User;
        $addcoordinator->name = $request->name;
        $addcoordinator->email = $request->email;
        $addcoordinator->password = Hash::make($request->password);
        $addcoordinator->type = '2';
        $career = App\Career::FindOrFail($request->careers);
        $addcoordinator->career_id=$career->id;
        $addcoordinator->save();

        return redirect('coordinadores')->with('message', "El coordinador $request->name ha sido agregado exitosamente!");

    }

    public function editcoordinators(){
        $coordinators="";
        return view('coordinators.edit_coordinators', compact('coordinators'));
    }

    public function Rules(){
        return [
            'name' => 'required',
            'email'=>'required',
            'password'=>'required',
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
