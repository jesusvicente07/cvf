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
                                <label for="">Nombre:</label>
                                    <input type="text" name="name" class="form-control m-input {{ $errors->has('name') ? 'is-danger' : '' }} " value="{{ old('name') }}"  placeholder="Psicología educativa" autocomplete="off">
                                    @error('name')
                                      <div class="text-red">{{ $errors->first('name') }}</div>
                                    @enderror      
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="">Competencias de la trayectoria</label>
                                    <div class="form-inline">
                                        <select name="competition" class="form-control m-input {{ $errors->has('competitions') ? 'is-danger' : '' }} ">
                                            @foreach($competitions as $competition)
                                                <option value="{{$competition->courses}}">
                                                    {{$competition->name}}
                                                </option>
                                            @endforeach
                                            @error('competitions')
                                                <div class="text-red">{{ $errors->first('competitions') }}</div>
                                            @enderror 
                                        </select>
                                        <div id="addcompetition" class="btn btn-primary mr-4" ><i class="fa fa-plus"></i></div>
                                    </div>
                                </div>

                                <div class="m-form__group">
                                    <table class="table table-hover ">
                                        <thead>
                                        </thead>
                                        <tbody >
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
        let name = $("option:selected").text();
        let tbody = "<tr><td><input hidden  name='competitions[]' value='"+ value[0].competition_id +"'> " + name + "</td><td><a onclick='showModal("+JSON.stringify(value)+")' class='text-body'><i class='fa fa-book' style='font-size:150%'></i></a> &nbsp;&nbsp; <a  class='delete' class='text-body'><i class='fa fa-trash' style='font-size:150%'></i></a></td></tr>";
        $("table tbody").append(tbody);
    }
});
$("table tbody").on("click", ".delete", function() {
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