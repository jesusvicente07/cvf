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
                                        Nueva trayectoria
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form action="{{ route('storeTrajectories') }}" method="post" class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
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
                                <label>Nombre:</label>
                                    <input type="text" name="name" class="form-control m-input {{ $errors->has('name') ? 'is-danger' : '' }} " value="{{ old('name') }}" minlength="3" maxlength="50" placeholder="Psicología educativa" autocomplete="off">
                                    @error('name')
                                      <div class="text-red">{{ $errors->first('name') }}</div>
                                    @enderror      
                                </div>
                                <div class="form-group m-form__group">
                                    <label>Competencias de la trayectoria</label>
                                    <div class="form-inline">
                                        <select name="competition" class="form-control m-input {{ $errors->has('competitions') ? 'is-danger' : '' }} ">
                                            @foreach($competitions as $competition)
                                                <option value="{{isset($competition->courses[0]) ? $competition->courses : $competition}}">
                                                    {{$competition->name}}
                                                </option>
                                            @endforeach
                                            @error('competitions')
                                                <div class="text-red">{{ $errors->first('competitions') }}</div>
                                            @enderror 
                                        </select>
                                        <div id="addcompetition" class="btn btn-primary mr-4" ><i class="fa fa-plus"></i></div>
                                    </div>
                                    @error('competitions')
                                        <div class="text-red">{{ $errors->first('competitions') }}</div>
                                    @enderror 
                                </div>

                                <div class="m-form__group">
                                    <table class="table table-bordered" style="text-align:left">
                                        <thead class="thead-dark"> 
                                        <tr>
                                            <th scope="col">Competencias</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody id="newcompetition" >
                                        </tbody>
                                    </table>    
                                </div>

                                <div class="form-group m-form__group">
                                    <label>Asociar trayectoria a carreras</label>
                                    <div class="form-inline">
                                        <select name="career" class="form-control m-input {{ $errors->has('careers') ? 'is-danger' : '' }} ">
                                            @foreach($careers as $career)
                                                <option value="{{$career->id}}">
                                                    {{$career->name}}
                                                </option>
                                            @endforeach
                                            @error('careers')
                                                <div class="text-red">{{ $errors->first('careers') }}</div>
                                            @enderror 
                                        </select>
                                        <div id="addcareer" class="btn btn-primary mr-4" ><i class="fa fa-plus"></i></div>
                                    </div>
                                    @error('careers')
                                        <div class="text-red">{{ $errors->first('careers') }}</div>
                                    @enderror 
                                </div>

                                <div class="m-form__group">
                                    <table class="table table-bordered" style="text-align:left">
                                        <thead class="thead-dark"> 
                                        <tr>
                                            <th scope="col">Carreras</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody id="newcareer" >
                                        </tbody>
                                    </table>    
                                </div>

                                <div class="m-form__group" style="text-align: right;">
                                    <input type="submit"  class="btn btn-primary "  value="Guardar">
                                </div>
                                
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="courseModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body" style="text-align: center;">
                    <strong>Cursos de la competencia:</strong>
                    <p class="ml-5" id="text">
                        <ul style="text-align:left" id="courses"> 
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
$('#addcompetition').click(function(){
    let value =JSON.parse($("select[name='competition']").val());
    if(value){
        let name = $("select[name='competition'] > option:selected").text();
        var competition_id='';
        var course ='';
        if(typeof value[0] !== 'undefined'){
            competition_id=value[0].pivot.competition_id;
            course=value;
        }else{
            competition_id=value.id;
        }
        let tbody = "<tr><td><input hidden  name='competitions[]' value='"+ competition_id +"'> " + name + "</td><td><a onclick='showModal("+JSON.stringify(course)+")' class='text-body'><i class='fa fa-book' style='font-size:150%'></i></a> &nbsp;&nbsp; <a  class='delete' class='text-body'><i class='fa fa-trash' style='font-size:150%'></i></a></td></tr>";
        $("#newcompetition").append(tbody);
    }
});
$("#newcompetition").on("click", ".delete", function() {
   $(this).closest("tr").remove();
});

$('#addcareer').click(function(){
    let value =$("select[name='career']").val();
    if(value){
        let name = $("select[name='career'] > option:selected").text();
        let tbody = "<tr><td><input hidden  name='careers[]' value='"+ value +"'> " + name + "</td><td><a  class='delete' class='text-body'><i class='fa fa-trash' style='font-size:150%'></i></a></td></tr>";
        $("#newcareer").append(tbody);
    }
});

$("#newcareer").on("click", ".delete", function() {
   $(this).closest("tr").remove();
});

function showModal(course){
    $('#courses').html('');
    $.each(course, function(index, value){
        $('#courses').append('<li>'+value.name+'</li>');
    });
    $('#courseModal').modal();
}

@if(session('message'))
    $('#message').fadeIn();
    $('#message').fadeOut(5000);

@endif
</script>
@endsection