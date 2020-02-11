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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function coordinators(){
        $coordinators="";
        if(request('search')){
            $search=request('search');
            $coordinators=App\User::where('name','LIKE',"%{$search}%")->paginate(5);
        }else{
            $coordinators=App\User::paginate(5);;
        }
        return view('coordinators.list_coordinators', compact('coordinators'));
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
        $addcoordinator->save();
        $career = App\Career::FindOrFail($request->careers);
        $career->user_id=$addcoordinator->id;
        $career->save();

        return redirect('coordinadores')->with('message', "El coordinador $request->name ha sido agregado exitosamente!");

    }

    public function editcoordinators(App\User $coordinator){
        $careers=App\Career::all();
        return view('coordinators.edit_coordinators', compact('coordinator','careers'));
    }

    public function updatecoordinators(App\User $coordinator){

        Validator::make(request()->all(),$this->Rules2())
        ->setAttributeNames($this->Attributes())
        ->validate();

        $coordinator->name=request('name');
        $coordinator->email=request('email');
        $coordinator->password=request('password') ?  Hash::make(request('password')) : $coordinator->password;
        $coordinator->type='2';
        $coordinator->save();

        $career = App\Career::FindOrFail(request('careers'));
        $career->user_id=$coordinator->id;
        $career->save();

        return redirect('editar/coordinador/'.$coordinator->id)->with('message', "El coordinador $coordinator->name ha sido actualizado exitosamente!");

    }

    public function deletecoordinators($id){
        $coordinator = App\User::findOrFail($id);
        $nameCoordinator = $coordinator->name;
        $coordinator->delete();
        return redirect('coordinadores')->with('message', "El coordinador $nameCoordinator ha sido eliminado exitosamente!");
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
