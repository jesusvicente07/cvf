@extends('layouts.admin')
@section('title', 'Curriculum Flexible')

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
                                    <input type="text" name="search" class="form-control m-input" style="width:50%" placeholder="Filtar .." minlength="1" autocomplete="off">      
                                </div>
                            </div>
                        </form>
                            <div class="m-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                         <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height">
                                            <table class="table table-bordered" style="text-align:left">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Trayectorias</th>
                                                        <th scope="col">Carreras</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if($trajectories)
                                                   @foreach($trajectories as $trajectorie)  
                                                    <tr>
                                                        <td>{{ $trajectorie->name}}</td>
                                                        <td>
                                                            <a onclick='showModalCarrer({{$trajectorie->careers}})' class='text-body'><i class='fa fa-book' style='font-size:150%'></i></a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('editTrajectories',$trajectorie) }}" class="btn text-body"><i class="fa fa-pencil" style="font-size:150%"></i></a>
                                                            <button class=" btn text-body"><i class="fa fa-trash" onclick="showModal({{$trajectorie}})" style="font-size:150%"></i></button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                        No hay registros
                                                @endif
                                                </tbody>
                                            </table>
                                            {{$trajectories->links()}}    
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body" style="text-align: center;">
                    <strong>Seguro que desea eliminar la trayectoria:</strong>
                    <p class="ml-5" id="text"></p>
                </div>
                 <!-- Modal footer -->
                <div class="modal-footer">
                    <form action="#" id="formModal" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-default" value="Eliminar" >
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="carrerModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body" style="text-align: center;">
                    <strong>Carreras de la trayectoria:</strong>
                    <p class="ml-5" id="text">
                        <ul style="text-align:left" id="carrer"> 
                        </ul>
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
function showModal(trajectorie){
    $('#text').html(trajectorie.name);
    $('#formModal').attr('action', '/eliminar/trayectoria/'+trajectorie.id);
    $('#deleteModal').modal();
}
function showModalCarrer(carrers){
    $('#carrer').html('');
    $.each(carrers, function(index, value){
        $('#carrer').append('<li>'+value.name+'</li>');
    });
    $('#carrerModal').modal();
}
</script>
@endsection