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
                                        Nueva competencia
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form action="{{ route('storecompetitions') }}" method="POST" class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
                        @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    <label>Nombre</label>
                                    <input type="text" name="name" class="form-control m-input {{ $errors->has('name') ? 'is-danger' : '' }} "  placeholder="e.g. Evaluación WISC IV" value="{{ old('name') }}" autocomplete="off">
                                    @error('name')
                                      <div class="text-red">{{ $errors->first('name') }}</div>
                                    @enderror   
                                </div>
                                <div class="m-form__group">
                                    <label>Cursos que conforman la competencia</label>
                                    <div class="form-inline">
                                        <input type="text" name="course_name" class="form-control m-input {{ $errors->has('courses') ? 'is-danger' : '' }}" placeholder="Nombre" value="{{ old('course_name') }}" autocomplete="off"> 
                                        <input type="text" name="link" class="form-control m-input mr-3 {{ $errors->has('courses') ? 'is-danger' : '' }}" placeholder="Enlace" value="{{ old('link') }}" autocomplete="off"> 
                                        <div class="btn btn-primary mr-4" id="addcompetition"><i class="fa fa-plus"></i></div>
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
                                                <th scope="col">Enlaces</th>
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
var count_courses=0;
$('#addcompetition').click(function(){
    let course_name = $("input[name='course_name']").val();
    let link = $("input[name='link']").val();
    if(course_name && link)
    {
        let tbody = "<tr><td><input hidden  name='courses["+ count_courses +"][name]' value='"+ course_name +"'> " + course_name + "</td><td><input hidden  name='courses["+ count_courses +"][link]' value='"+ link +"'> " + link + "</td><td><a class='delete' class='text-body'><i class='fa fa-trash' style='font-size:150%'></i></a></td></tr>";
        $("table tbody").append(tbody);
        count_courses++;
    }
});
$("table tbody").on("click", ".delete", function() {
   $(this).closest("tr").remove();
});
</script>
@endsection