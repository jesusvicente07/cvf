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
                                <div class="form-group m-form__group">
                                <label for="">Nombre:</label>
                                    <input type="text" name="name" class="form-control m-input {{ $errors->has('name') ? 'is-danger' : '' }} " value="{{ old('name') }}"  placeholder="Psicología educativa">
                                    @error('name')
                                      <div class="text-red">{{ $errors->first('name') }}</div>
                                    @enderror      
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="">Competencias de la trayectoria</label>
                                    <div class="form-inline">
                                        <select name="competition" class="form-control m-input {{ $errors->has('competitions') ? 'is-danger' : '' }} ">
                                            @foreach($competitions as $competition)
                                                <option value="{{$competition->id}}">
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
@endsection

@section('customScripts')
<script>
var cursos=[];
$('#addcompetition').click(function(){
    let value = $("select[name='competition']").val();
     cursos+=['hola': 1,'link' : 2];
    console.log(cursos);
    if(value){
        let name = $("option:selected").text();
        let tbody = "<tr><td><input hidden  name='competitions[]' value='"+ value +"'> " + name + "</td><td><a  class='delete' class='text-body'><i class='fa fa-trash' style='font-size:150%'></i></a></td></tr>";
        $("table tbody").append(tbody);
    }
});
$("table tbody").on("click", ".delete", function() {
   $(this).closest("tr").remove();
});
</script>
@endsection