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
                                        Nueva competencia
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form action="{{ route('storecompetitions') }}" method="POST" class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
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
                                    <input type="text" name="name" class="form-control m-input {{ $errors->has('name') ? 'is-danger' : '' }} "  placeholder="e.g. Evaluación WISC IV" value="{{ old('name') }}" minlength="3" maxlength="50" autocomplete="off">
                                    @error('name')
                                      <div class="text-red">{{ $errors->first('name') }}</div>
                                    @enderror   
                                </div>
                                <div class="m-form__group"> <label>Cursos que conforman la competencia</label>
                                    <div class="form-inline">
                                        <select name="course" class="form-control m-input {{ $errors->has('courses') ? 'is-danger' : '' }} ">
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}">
                                                    {{$course->name}}
                                                </option>
                                            @endforeach
                                        </select> 
                                        <div id="addcourses" class="btn btn-primary mr-4" ><i class="fa fa-plus"></i></div>
                                    </div>
                                    @error('courses')
                                        <div class="text-red">{{ $errors->first('courses') }}</div>
                                    @enderror 
                                </div>
                                <div class="m-form__group">
                                    <table class="table table-bordered" style="text-align:left">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Cursos</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>  
                                </div>
                                    <div class="m-form__group" style="text-align: right;">
                                        <input type="submit" class="btn btn-primary"  value="Guardar">
                                    </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')
<script>
$('#addcourses').click(function(){
    let value = $("select[name='course']").val();
    if(value){
        let name = $("option:selected").text();
        let tbody = "<tr><td><input hidden  name='courses[]' value='"+value  +"'> " + name + "</td><td><a  class='delete' class='text-body'><i class='fa fa-trash' style='font-size:150%'></i></a></td></tr>";
        $("table tbody").append(tbody);
    }
});
$("table tbody").on("click", ".delete", function() {
   $(this).closest("tr").remove();
});

@if(session('message'))
    $('#message').fadeIn();
    $('#message').fadeOut(5000);
@endif
</script>
@endsection