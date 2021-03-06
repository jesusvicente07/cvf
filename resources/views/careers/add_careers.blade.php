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
                                        Nueva carrera
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form action="{{ route('storecareers') }}" method="post" class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
                        @csrf
                            <div class="m-portlet__body">
                                @if(session('message'))
                                <div class="form-group m-form__group" id="message">
                                    <div class="alert alert-danger alert-dismissible">
                                        {{session('message')}}                                        
                                    </div>
                                </div>
                                @endif
                                <div class="form-group m-form__group">
                                    <label>Nombre</label>
                                    <input type="text" name="name" class="form-control m-input {{ $errors->has('name') ? 'is-danger' : '' }} " value="{{ old('name') }}" placeholder="e.g. Licenciatura en Psicología" autocomplete="off" minlength="3" maxlength="50"> 
                                        @error('name')
                                            <div class="text-red">{{ $errors->first('name') }}</div>
                                        @enderror   
                                </div>
                                <div class="m-form__group"> <label>Trayectorias profesionales</label>
                                    <div class="form-inline">
                                        <select name="trajectorie" class="form-control m-input {{ $errors->has('trajectories') ? 'is-danger' : '' }} ">
                                            @foreach($trajectories as $trajectorie)
                                                <option value="{{ isset($trajectorie->competitions[0]) ? $trajectorie->competitions : $trajectorie }}">
                                                    {{$trajectorie->name}}
                                                </option>
                                            @endforeach
                                        </select> 
                                        <div id="addtrajectories" class="btn btn-primary mr-4" ><i class="fa fa-plus"></i></div>
                                    </div>
                                    @error('trajectories')
                                        <div class="text-red">{{ $errors->first('trajectories') }}</div>
                                    @enderror 
                                </div>
                                <div class="m-form__group">
                                    <table class="table table-bordered" style="text-align:left">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Trayectorias</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table> 
                                </div>
                                    <div class="form-group m-form__group" style="text-align:right;">
                                        <input type="submit" class="btn btn-primary"  value="Guardar">    
                                    </div>
                            </div>
                        </form>        
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="competitionModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="text-align:center">
                    <strong>Competencias:</strong>
                    <p class="ml-5" id="text">
                        <ul style="text-align:left" id="competitions"> 
                        </ul>
                    </p>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
            </div> 
        </div>
    </div>


@endsection

@section('customScripts')
<script>
$('#addtrajectories').click(function(){
    let value = JSON.parse($("select[name='trajectorie']").val());
    
    if(value){
        let name = $("option:selected").text();
        var trajectorie_id='';
        var competitions ='';
        if(typeof value[0] !== 'undefined'){
            trajectorie_id=value[0].pivot.trajectorie_id;
            competitions=value;
        }else{
            trajectorie_id=value.id;
        }
        let tbody = "<tr><td><input hidden  name='trajectories[]' value='"+trajectorie_id  +"'> " + name + "</td><td><a class='text-body' onclick='showModal("+JSON.stringify(competitions)+")'><i class='fa fa-book' style='font-size:150%'></i></a> &nbsp;&nbsp; <a  class='delete' class='text-body'><i class='fa fa-trash' style='font-size:150%'></i></a></td></tr>";
        $("table tbody").append(tbody);
    }
});
$("table tbody").on("click", ".delete", function() {
   $(this).closest("tr").remove();
});

function showModal(competition){
    $('#competitions').html('');
    $.each(competition, function(index, value){
        $('#competitions').append('<li>'+value.name+'</li>');
    });
    $('#competitionModal').modal();
}

@if(session('message'))
    $('#message').fadeIn();
    $('#message').fadeOut(5000);

@endif
</script>
@endsection