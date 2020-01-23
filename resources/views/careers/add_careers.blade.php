@extends('layouts.admin')
@section('title', 'Cvf')

@section('customStyles')

@endsection

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                    <h3 class="m-portlet__head-text">
                                        Nueva carrera
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
                        @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control m-input"  placeholder="e.g. Licenciatura en Psicología" autocomplete="off"> 
                                </div>
                                <div class="m-form__group"> <label>Trayectorias profesionales</label>
                                    <div class="form-inline">
                                        <select name="trajectorie" class="form-control m-input {{ $errors->has('trajectories') ? 'is-danger' : '' }} ">
                                            @foreach($trajectories as $trajectorie)
                                                <option value="{{$trajectorie->id}}">
                                                    {{$trajectorie->name}}
                                                </option>
                                            @endforeach
                                            @error('trajectories')
                                                <div class="text-red">{{ $errors->first('trajectories') }}</div>
                                            @enderror 
                                        </select> 
                                        <div class="btn btn-primary mr-4" ><i class="fa fa-plus"></i></div>
                                    </div>
                                </div>
                                <div class="m-form__group">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Psicología educativa</th>
                                                <td><a href="#" class="text-body"><i class="fa fa-trash" style="font-size:150%"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Psicologia del adolecente</th>
                                                <td><a href="#" class="text-body"><i class="fa fa-trash" style="font-size:150%"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table> 
                                </div>
                                    <div class="form-group m-form__group" style="text-align:right;">
                                        <a class="btn btn-primary" href="">Guardar</a>     
                                    </div>
                            </div>
                        </form>        
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')

@endsection