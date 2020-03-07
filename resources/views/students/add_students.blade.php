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
                                        Nuevo estudiante
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form action="{{route('storestudents')}}" method="POST" class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
                        @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    <label>Nombre</label>
                                    <input type="text" name="name" class="form-control m-input {{ $errors->has('name') ? 'is-danger' : '' }} "  placeholder="example" value="{{ old('name') }}" minlength="3" maxlength="50" autocomplete="off">
                                    @error('name')
                                      <div class="text-red">{{ $errors->first('name') }}</div>
                                    @enderror
                                </div>
                                <div class="form-group m-form__group">      
                                    <label>Correo</label>
                                    <input type="email" name="email" class="form-control m-input {{ $errors->has('email') ? 'is-danger' : '' }} "  placeholder="example@gmail.com" value="{{ old('email') }}" minlength="3" maxlength="50" autocomplete="off">
                                    @error('email')
                                      <div class="text-red">{{ $errors->first('email') }}</div>
                                    @enderror 
                                </div>    
                                <div class="form-group m-form__group">
                                    <label>Contraseña</label>
                                    <input type="password" name="password" class="form-control m-input {{ $errors->has('password') ? 'is-danger' : '' }} "  placeholder="********" value="{{ old('password') }}" minlength="8" maxlength="50" autocomplete="off">
                                    @error('password')
                                      <div class="text-red">{{ $errors->first('password') }}</div>
                                    @enderror  
                                </div>
                                <div class="m-form__group"> <label>Carrera</label>
                                    <div class="form-inline">
                                        <select name="careers" class="form-control m-input {{ $errors->has('careers') ? 'is-danger' : '' }} ">
                                            @foreach($careers as $career)
                                                    <option value="{{$career->id}}">
                                                        {{$career->name}}
                                                    </option>
                                            @endforeach
                                        </select> 
                                    </div>
                                    @error('careers')
                                        <div class="text-red">{{ $errors->first('careers') }}</div>
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
<script>
</script>
@endsection