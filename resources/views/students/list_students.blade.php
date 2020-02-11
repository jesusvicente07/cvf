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
                                        Estudiantes
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form action="{{route('students')}}" method="get" class="m-form m-form--fit m-form--label-align-right">
                        @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                @if(session('message'))
                                        <div class="alert alert-success alert-dismissible">
                                            {{session('message')}}                                        
                                        </div>
                                @endif
                                    <a class="btn btn-primary" href="{{route('addstudents')}}"><i class="fa fa-plus"></i>Agregar estudiantes</a>
                                    <input type="text" class="form-control m-input" style="width:50%" placeholder="Filtar .." autocomplete="off">      
                                </div>
                            </div>
                        </form>
                            <div class="m-form__group">
                                <div class="m-portlet__body">
                                    <table class="table table-bordered" style="text-align:left">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Estudiantes</th>
                                                <th scope="col">Carreras</th>
                                                <th scope="col">Trayectorias iniciadas</th>
                                                <th scope="col">Trayectorias completadas</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{$student->name}}</td>
                                                <td>{{ isset($student->careers->name) ? $student->careers->name : '' }}</td>
                                                <td>5</td>
                                                <td>2</td>
                                                <td>
                                                    <a href="{{route('studentprogress')}}" class=" btn text-body"><i class="fa fa-eye" style="font-size:150%"></i></a>
                                                    <a href="{{route('editstudents',$student)}}" class=" btn text-body"><i class="fa fa-pencil" style="font-size:150%"></i></a>
                                                    <button class="btn text-body" onclick="Mymodal({{ $student }})"><i class="fa fa-trash" style="font-size:150%"></i></button>
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

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="text-align:center">
                    <strong>Seguro que desea eliminar al estudiante:</strong>
                    <p id="text"></p>
                </div>
                <div class="modal-footer">
                    <form action="#" id="formModal" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-default" value="Eliminar">
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div> 
        </div>
    </div>

@endsection

@section('customScripts')
<script>
    function Mymodal(student){
      $('#text').html(student.name);
      $('#formModal').attr('action', '/eliminar/estudiante/'+student.id);
      $('#myModal').modal();
    }

    @if(session('message'))
        $('.alert-success').fadeIn();
        $('.alert-success').fadeOut(5000);

    @endif
</script>
@endsection