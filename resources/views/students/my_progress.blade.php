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
                                <div class="form-group m-form__group" id="message">
                                    <div class="alert alert-success alert-dismissible">
                                        {{session('message')}}                                        
                                    </div>
                                </div>
                            @endif
                            @if(session('message2'))
                                <div class="form-group m-form__group" id="message">
                                    <div class="alert alert-danger alert-dismissible">
                                        {{session('message2')}}                                        
                                    </div>
                                </div>
                            @endif
                                <div class="form-group m-form__group" style="text-align:left">
                                    <label>Trayectorias profesionales iniciadas</label>     
                                </div>
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
                                                <th scope="col" colspan="3">{{$competition->name}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Cursos</strong></td>
                                                <td><strong>Información</strong></td>
                                                <td><strong>Evidencias</strong></td>
                                                <tr></tr>
                                                @foreach($competition->courses as $course)
                                                    <td>{{$course->name}}</td>
                                                    <td><a onclick='showModalCourse({{$course}})' class='text-body'><i class='fa fa-book' style='font-size:150%'></i></a></td>
                                                    <td>
                                                        <div class="m-form__group">
                                                            <div class="form-inline">
                                                                <div class="form-inline mt-2">
                                                                    <button class="btn btn-primary" onclick='showModal({{$student->id}},{{$course->id}})' >Enviar</button>&nbsp; &nbsp;
                                                                    <input class="btn btn-success" value="Iniciar" type="submit">  &nbsp; &nbsp;
                                                                    <input class="btn btn-warning" value="Pausear" type="submit">
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
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="evidenceModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body" style="text-align: center;">
                    <strong>Evicencia:</strong>
                    <div id="evidence">
                        <form action="{{route('studentsevidences')}}" method="post" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" hidden class="form-control m-input">
                            <input type="text" hidden name="courses" id="courses" > 
 
                        </form>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="courseModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <!-- Modal body -->
                <div class="modal-body" style="text-align: justify;">
                    <strong>Información del curso:</strong> <br> <br>
                    <p>
                    <strong>Tipo:</strong> <label id="type"></label> <br>
                    <strong>Link:</strong> <label id="link"></label> <br>
                    <strong>Objetivo:</strong> <label id="objective"></label> <br>
                    <strong>Contenido:</strong>
                    <textarea class="form-control m-input" autocomplete="off" id="content" style="height:300px" disabled="true"></textarea>
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
//Dropzone.autoDiscover=false;
var myDropzone = new Dropzone("form#my-awesome-dropzone",{url: "/evidencias", addRemoveLinks: true,maxFilesize: 5,headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }});

myDropzone.on("removedfile", function(file) {
    console.log(file.id);
    $.ajax({
        url:'/eliminar/evidencia/'+file.id,
        type:'delete',
        data:{file:file.name},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            console.log(response);
        },
        error:function(err1,err2){
            console.log(err1,err2);

        }

    });
    
});

function showModal(idS,idC){
    console.log(idS,idC);
    if ($('.dz-image-preview').length) {
        $('.dz-image-preview').remove();
    }
    $('#courses').val(idC);
    $.ajax({
        url:'/obtener/evidencia/'+idS+'/'+idC,
        type:'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            console.log(response);
            if(response.length){
                $('.dz-message').hide();
                $.each(response,function(i,value){
                    let mockFile = { name:value.evidence , size: 12345, id:value.id };
                    myDropzone.emit('addedfile', mockFile);
                    myDropzone.emit('thumbnail', mockFile, 'http://127.0.0.1:8000/'+value.evidence);
                    myDropzone.emit('complete', mockFile);
                });
            }else{
                console.log('hola');
                $('.dz-message').show();
            }
            
        },
        error:function(err1,err2){
            console.log(err1,err2);

        }

    });
    $('#evidenceModal').modal();
}

@if(session('message'))
    $('#message').fadeIn();
    $('#message').fadeOut(5000);
@endif
@if(session('message2'))
    $('#message').fadeIn();
    $('#message').fadeOut(5000);
@endif

function showModalCourse(course){
        $('#type').html('');
        $('#objective').html('');
        $('#content').html('');
        $('#objective').append(course.objective);
        $('#content').append(course.content);
        $('#courseModal').modal();
        if(course.link){
            $('#link').html('');
            $('#link').append(course.link);
        }
        else{
            $('#link').html('');
            $('#link').append("");
        }
        if(course.type=="face-to-face"){
            $('#type').append("presencial");
        }
        else{
            $('#type').append("virtual");
        }
    }
</script>
@endsection