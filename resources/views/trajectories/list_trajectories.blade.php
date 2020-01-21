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
                                        Trayectorias
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form class="m-form m-form--fit m-form--label-align-right">
                        @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    <input type="text" class="form-control m-input" style="width:50%" placeholder="Filtar ..">      
                                </div>
                            </div>
                        </form>
                            <div class="m-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                         <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height">
                                            <table class="table table-hover text-center">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Trayectoria</th>
                                                        <th scope="col">Carrera</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                        <td>
                                                            <a href="#" class="text-body"><i class="fa fa-eye" style="font-size:150%"></i></a>
                                                            <a href="#" class="text-body"><i class="fa fa-trash" style="font-size:150%"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')

@endsection