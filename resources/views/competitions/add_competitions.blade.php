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
                                        Nueva competencia
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
                        @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control m-input"  placeholder="e.g. Evaluación WISC IV"> 
                                </div>
                                <div class="m-form__group">
                                    <label>Cursos que conforman la competencia</label>
                                    <div class="form-inline">
                                        <input type="text" class="form-control m-input"  placeholder="Nombre"> 
                                        <input type="text" class="form-control m-input mr-3"  placeholder="Enlace"> 
                                        <a class="btn btn-primary mr-5"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="m-form__group">
                                    <table class="table table-hover text-center">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Udemy - Como evaluar</th>
                                                <td>http://udemy.com/mi-curso</td>
                                                <td><a href="#" class="text-body"><i class="fa fa-trash" style="font-size:150%"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Khan Academy - curso 2</th>
                                                <td>http://khanacademy.org/mi-curso</td>
                                                <td><a href="#" class="text-body"><i class="fa fa-trash" style="font-size:150%"></i></a></td>
                                            </tr>
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