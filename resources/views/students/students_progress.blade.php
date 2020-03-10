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
                                        {{$student->name}}
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
                                    <label class="m-portlet__head-text">{{$student->careers->name}}</label>
                            </div>
                        </div>
                    </div>
                        
                        <div class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                @if(session('message'))
                                    <div class="alert alert-danger alert-dismissible">
                                        {{session('message')}}                                        
                                    </div>
                                @endif
                                <div class="form-group m-form__group" style="text-align:left">
                                    <label>Trayectorias profesionales iniciadas</label>     
                                </div>
                                @foreach($student->trajectories as $trajectorie)
                                <div class="form-group m-form__group" style="text-align:left">
                                    <strong><h3>{{$trajectorie->name}}</h3></strong>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                    </div>     
                                </div>
                                <div class="m-form__group">
                                    <table class="table table-bordered" style="text-align:left">
                                    @foreach($trajectorie->competitions as $competition)
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col" colspan="2">{{$competition->name}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Cursos</strong></td>
                                                <td><strong>Evidencias</strong></td>
                                                <tr></tr>
                                                @foreach($competition->courses as $course)
                                                <td>{{$course->name}}</td>
                                                <td>
                                                    <div class="m-form__group">
                                                        <div class="form-inline">
                                                            <div class="form-inline mt-2">
                                                                <button class="btn btn-primary" onclick="myModal({{$student->id}},{{$course->id}})" >Mostrar</button>&nbsp; &nbsp;
                                                                <button class="btn btn-success" onclick="Mymodal({{$student}})">Aprobar</button>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </td>
                                                <tr></tr>
                                                <tr>
                                                @endforeach
                                                </tr>
                                            </tr>   
                                    @endforeach 
                                        </tbody>
                                    </table>   
                                </div>
                                @endforeach
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
                    <strong>Necesitas confirmar para aprobar el curso:</strong>
                </div>
                <div class="modal-footer">
                    <form action="#" id="formModal" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-default" value="Confirmar">
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal body -->
                <div class="modal-body" style="text-align: center;">
                    <strong>Evidencias del estudiante:</strong>
                    <p class="ml-5" id="text">
                    <ul style="text-align:left" id="evidence"></ul>
                    </p>
                </div>

                    <!-- Modal footer -->
                <div class="modal-footer">
                <form id="formModal1" action="#" method="post">
                @csrf
                    <input type="submit" class="btn btn-default" value="Descargar">
                </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                
                </div>

            </div>
        </div>
    </div>

@endsection

@section('customScripts')
<script>
    @if(session('message'))
        $('.alert-danger').fadeIn();
        $('.alert-danger').fadeOut(5000);
    @endif

    function Mymodal(student){
      $('#formModal').attr('action', '/eliminar/estudiante/'+student.id);
      $('#myModal').modal();
    }
    

    function myModal(idS,idC){
        $('#evidence').html('');
        $.ajax({
            url:'/obtener/evidencia/'+idS+'/'+idC,
            type:'get',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success:function(response){
            
                console.log(response);
                $.each(response, function(index, value){
                    $('#evidence').append('<li>'+value.evidence+'</li>');
                });
            
            },
            error:function(err1,err2){
                console.log(err1,err2);

            }
        });
        $('#formModal1').attr('action', '/descargar/evidencia/'+idS+'/'+idC);
        $('#myModal2').modal();
    }
</script>
@endsection