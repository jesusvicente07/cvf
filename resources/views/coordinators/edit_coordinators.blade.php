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
                                        Editar coordinador
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form action="" method="POST" class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
                        @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    <label>Nombre</label>
                                    <input type="text" name="name" class="form-control m-input {{ $errors->has('name') ? 'is-danger' : '' }} "  placeholder="Jesus Vicente" value="{{ old('name') }}" autocomplete="off">
                                    @error('name')
                                      <div class="text-red">{{ $errors->first('name') }}</div>
                                    @enderror
                                </div>
                                <div class="form-group m-form__group">      
                                    <label>Correo</label>
                                    <input type="text" name="email" class="form-control m-input {{ $errors->has('email') ? 'is-danger' : '' }} "  placeholder="example@gmail.com" value="{{ old('email') }}" autocomplete="off">
                                    @error('email')
                                      <div class="text-red">{{ $errors->first('email') }}</div>
                                    @enderror 
                                </div>    
                                <div class="form-group m-form__group">
                                    <label>Contraseña</label>
                                    <input type="text" name="password" class="form-control m-input {{ $errors->has('password') ? 'is-danger' : '' }} "  placeholder="********" value="{{ old('password') }}" autocomplete="off">
                                    @error('password')
                                      <div class="text-red">{{ $errors->first('password') }}</div>
                                    @enderror  
                                </div>
                                <div class="m-form__group"> <label>Carrera</label>
                                    <div class="form-inline">
                                        <select name="" class="form-control m-input {{ $errors->has('') ? 'is-danger' : '' }} ">
                                                
                                                <option value="">
                                                    
                                                </option>
            
                                        </select> 
                                    </div>
                                    @error('kkk')
                                        <div class="text-red"></div>
                                    @enderror 
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
<!--<script>
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

@if(session('message'))
    $('#message').fadeIn();
    $('#message').fadeOut(5000);

@endif
</script>-->
@endsection