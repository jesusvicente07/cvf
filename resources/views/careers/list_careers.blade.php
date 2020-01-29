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
                                        Carreras
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <div class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    @if(session('message'))
                                        <div class="alert alert-success alert-dismissible">
                                            {{session('message')}}                                        
                                        </div>
                                    @endif
                                    <a class="btn btn-primary" href="{{route('addcareers')}}"><i class="fa fa-plus"></i>Agregar carrera</a>     
                                </div>
                                <div class="m-form__group">
                                    <table class="table table-hover text-center">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Carrera</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($careers as $career)
                                                <tr>
                                                    <td>{{$career->name}}</td>
                                                    <td>
                                                        <a href="{{route('editcareers',$career)}}" class="btn text-body"><i class="fa fa-pencil" style="font-size:150%"></i></a>
                                                        <button class="btn text-body" onclick="Mymodal({{$career}})"><i class="fa fa-trash" style="font-size:150%"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="text-align:center">
                    <strong>Seguro que desea eliminar la carrera:</strong>
                    <p id="text"></p>
                </div>
                <div class="modal-footer">
                    <form action="#" id="formModal" method="POST">
                    @method('DELETE')
                    @csrf
                        <button type="submit "class="btn btn-default">Eliminar</button>
                    </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div> 
        </div>
    </div>

@endsection

@section('customScripts')
<script>
  function Mymodal(career){
      $('#text').html(career.name);
      $('#formModal').attr('action', '/eliminar/carrera/'+career.id);
      $('#myModal').modal();
    }

    @if(session('message'))
        $('.alert-success').fadeIn();
        $('.alert-success').fadeOut(5000);

    @endif
</script>
@endsection