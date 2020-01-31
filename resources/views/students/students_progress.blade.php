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
                                        Manuel Torres
                                    </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                    <label class="m-portlet__head-text">Lic. en Administración</label>
                            </div>
                        </div>
                    </div>
                        
                        <form class="m-form m-form--fit m-form--label-align-right">
                        @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group" style="text-align:left">
                                    <label>Trayectorias profesionales iniciadas</label>     
                                </div>
                                <div class="form-group m-form__group" style="text-align:left">
                                    <strong><h3>Administración agrícola</h3></strong>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                    </div>     
                                </div>
                                <div class="m-form__group">
                                    <table class="table table-bordered" style="text-align:left">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Competencias</th>
                                                <th scope="col">Cursos</th>
                                                <th scope="col">Tomados</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="2">Semillas</td>
                                                <td>Curso 1 de semillas</td>
                                                <td>
                                                <a href="#" class="text-body"><i class="fa fa-check" style="font-size:150%"></i></a> &nbsp;  &nbsp;
                                                <a class="btn btn-primary" href="">Aprobar</a> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Curso 2 de semillas</td>
                                                <td>
                                                <a href="#" class="text-body"><i class="fa fa-check" style="font-size:150%"></i></a> &nbsp;  &nbsp;
                                                <a class="btn btn-primary" href="">Aprobar</a> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">Exportación agrícola</td>
                                                <td>Exportación de semillas</td>
                                                <td>
                                                <a href="#" class="text-body"><i class="fa fa-check" style="font-size:150%"></i></a> &nbsp;  &nbsp;
                                                <a class="btn btn-primary" href="">Aprobar</a> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Exportación de hortalizas</td>
                                                <td>
                                                <a href="#" class="text-body"><i class="fa fa-check" style="font-size:150%"></i></a> &nbsp;  &nbsp;
                                                <a class="btn btn-primary" href="">Aprobar</a> 
                                                </td>
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