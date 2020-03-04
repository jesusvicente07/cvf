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
                        @csrf
                            <div class="m-portlet__body">
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
                                                        <?php $sT=1; $sF=1; ?>
                                                        @foreach($student->courses as $c)
                                                        @if($c->pivot->status && $course->id == $c->pivot->course_id)
                                                                @if(1 == $sT)
                                                                    <a class="text-body"><i class="fa fa-check" style="font-size:150%"></i></a> &nbsp; &nbsp;
                                                                    <?php $sT++; ?>
                                                                @endif
                                                        @elseif (!$c->pivot->status && $course->id == $c->pivot->course_id)
                                                                @if(1 == $sF)
                                                                    <a class="text-body"><i class="fa fa-close" style="font-size:150%"></i></a> &nbsp; &nbsp;
                                                                    <?php $sF++; ?>
                                                                @endif
                                                        @endif
                                                        @endforeach
                                                            <form action="{{route('studentsevidences')}}" method="post" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
                                                            @csrf
                                                                <input type="file" name="file" hidden class="form-control m-input"> &nbsp; &nbsp;
                                                                <input type="text" hidden value="{{$course->id}}" name="courses">
                                                            </form> &nbsp; &nbsp;
                                                            <div class="form-inline mt-2">
                                                                <button class="btn btn-primary" onclick="Mymodal({{ $student }})">Aprobar</button>
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

@endsection

@section('customScripts')
<script>
    function Mymodal(student){
      $('#formModal').attr('action', '/eliminar/estudiante/'+student.id);
      $('#myModal').modal();
    };

    $('.dropzone').dropzone({
    init: function(){
        let myDropzone =this;
        $.ajax({
            url:'/evidencias',
            type:'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                $.each(response,function(i,value){
                    let mockFile = { name:value.pivot.evidence , size: 12345, id:value.pivot.id };
                    myDropzone.emit('addedfile', mockFile);
                    myDropzone.emit('thumbnail', mockFile, 'http://127.0.0.1:8000/'+value.pivot.evidence);
                    myDropzone.emit('complete', mockFile);
                });
                
            },
            error:function(err1,err2){
                console.log(err1,err2);

            }

        });
        
        
    }
});
</script>
@endsection