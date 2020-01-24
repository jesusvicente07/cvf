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
                        <form action="{{ route('trajectories') }}" class="m-form m-form--fit m-form--label-align-right" method="get" >
                        @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                   @if(session('message'))
                                        <div class="alert alert-success alert-dismissible">
                                            {{session('message')}}                                        
                                        </div>
                                    @endif
                                    <a class="btn btn-primary" href="{{ route('createTrajectories') }}"><i class="fa fa-plus"></i>Agregar trayectoria</a>
                                    <input type="text" name="search" class="form-control m-input" style="width:50%" placeholder="Filtar .." autocomplete="off">      
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
                                                @if($trajectories)
                                                   @foreach($trajectories as $trajectorie)  
                                                    <tr>
                                                        <td>{{ $trajectorie->name}}</td>
                                                        <td>
                                                        @foreach($trajectorie->careers as $careers )
                                                             {{$careers->name}} <br>
                                                        @endforeach
                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-body"><i class="fa fa-pencil" style="font-size:150%"></i></a> &nbsp;&nbsp;
                                                            <a href="#" class="text-body"><i class="fa fa-trash" style="font-size:150%"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                        No hay registros
                                                @endif
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
<script>
@if(session('message'))
    $('.alert-success').fadeIn();
    $('.alert-success').fadeOut(5000);

@endif
</script>
@endsection