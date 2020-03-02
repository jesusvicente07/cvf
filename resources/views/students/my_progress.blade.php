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
                                                        @foreach($student->courses as $c)
                                                        @if($c->pivot->status && $course->id == $c->pivot->course_id)
                                                                <a class="text-body"><i class="fa fa-check" style="font-size:150%"></i></a> &nbsp; &nbsp;
                                                        @elseif (!$c->pivot->status && $course->id == $c->pivot->course_id)
                                                                <a class="text-body"><i class="fa fa-close" style="font-size:150%"></i></a> &nbsp; &nbsp;
                                                        @endif
                                                        @endforeach
                                                            <form action="{{route('studentsevidences')}}" method="post" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
                                                            @csrf
                                                                <input type="file" name="file" hidden class="form-control m-input"> &nbsp; &nbsp;
                                                                <input type="text" hidden value="{{$course->id}}" name="courses">
                                                            </form> &nbsp; &nbsp;
                                                            <div class="form-inline">
                                                                <input class="btn btn-primary" value="Enviar" type="submit"> &nbsp; &nbsp;
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
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customScripts')
<script>
Dropzone.autoDiscover=false;
$('.dropzone').dropzone({
    init: function(){
        myDropzone =this;
        console.log("hola");
        $.ajax({
            url:'/evidencias',
            type:'post',
            data:{data:1},
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
        
    }
});
/*Dropzone.options.myAwesomeDropzone = {
    paramName: "file", // Las imágenes se van a usar bajo este nombre de parámetro,
    maxFilesize: 2,// Tamaño máximo en MB
    success: function (file, response) {
        console.log(response);
    }
};
let mockFile = { name: "Filename", size: 12345 };
Dropzone.options.myAwesomeDropzone.displayExistingFile(mockFile, 'https://image-url');*/

@if(session('message'))
    $('#message').fadeIn();
    $('#message').fadeOut(5000);
@endif
@if(session('message2'))
    $('#message').fadeIn();
    $('#message').fadeOut(5000);
@endif
</script>
@endsection