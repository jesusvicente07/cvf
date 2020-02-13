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
                                        Editar trayectorias selecionadas
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form action="{{route('updatestudenttrajectories',$student)}}" method="post" class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
                        @method('PUT')
                        @csrf
                            <div class="m-portlet__body">
                            @if(session('message'))
                                <div class="form-group m-form__group" id="message">
                                        <div class="alert alert-success alert-dismissible">
                                            {{session('message')}}                                        
                                        </div>
                                </div>
                            @endif
                            @if(session('messageError'))
                                <div class="form-group m-form__group" id="messageError">
                                    <div class="alert alert-danger alert-dismissible">
                                        {{session('messageError')}}                                        
                                    </div>
                                </div>
                            @endif
                                <div class="form-group m-form__group">
                                    <h4>{{$student->name}}</h4> 
                                </div>
                                <div class="m-form__group"> <h5>{{  isset($student->careers->name) ? $student->careers->name : '' }}</h5>
                                <div class="form-inline" style="margin-top:4%">
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
                                            <th colspan="2" style="text-align:center">Nuevas trayectorias</th>
                                            </tr>
                                        </thead>
                                        <tbody id="newtrajectories">
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="m-form__group">
                                    <table class="table table-bordered" style="text-align:left">
                                        <thead class="thead-dark">
                                            <tr>
                                            <th colspan="2" style="text-align:center">Trayectorias selecionadas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($student->trajectories as $trajectorie)
                                        <tr>
                                            <td>{{$trajectorie->name}}</td>
                                            <td>
                                                <a onclick='showModal({{$trajectorie->competitions}})' class='text-body'><i class='fa fa-book' style='font-size:150%'></i></a> &nbsp;&nbsp;
                                                <a class="text-body" onclick="Mymodal({{$trajectorie}})"><i class="fa fa-trash" style="font-size:150%"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
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
        var trajectorie_id='';
        var competitions ='';
        if(typeof value[0] !== 'undefined'){
            trajectorie_id=value[0].pivot.trajectorie_id;
            competitions=value;
        }else{
            trajectorie_id=value.id;
        }
        let name = $("option:selected").text();
        let tbody = "<tr><td><input hidden  name='trajectories[]' value='"+ trajectorie_id +"'> " + name + "</td><td><a class='text-body' onclick='showModal("+JSON.stringify(competitions)+")'><i class='fa fa-book' style='font-size:150%'></i></a> &nbsp;&nbsp; <a  class='delete' class='text-body'><i class='fa fa-trash' style='font-size:150%'></i></a></td></tr>";
        $("#newtrajectories").append(tbody);
    }
});
$("#newtrajectories").on("click", ".delete", function() {
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

@if(session('messageError'))
    $('#messageError').fadeIn();
    $('#messageError').fadeOut(5000);

@endif
</script>
@endsection