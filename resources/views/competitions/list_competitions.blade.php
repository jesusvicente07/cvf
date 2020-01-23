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
                                        Competencias
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form class="m-form m-form--fit m-form--label-align-right">
                        @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    <a class="btn btn-primary" href="{{route('addcompetitions')}}"><i class="fa fa-plus"></i>Agregar competencia</a>
                                    <input type="text" class="form-control m-input" style="width:50%" placeholder="Filtar ..">      
                                </div>
                                <div class="m-form__group">
                                    <table class="table table-hover text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Competencia</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($competitions as $competition)
                                            <tr>
                                                <th scope="row">{{$competition->name}}</th>
                                                <td><a href="#" class="text-body"><i class="fa fa-pencil" style="font-size:150%"></i></a> &nbsp;&nbsp;
                                                <a href="#" class="text-body"><i class="fa fa-trash" style="font-size:150%"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>   
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