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
                                        Nuevo curso
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form action="{{route('storecourses')}}" method="post" class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
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
                                <div class="m-form__group"> 
                                    <label>Tipo</label>
                                    <div class="form-inline">
                                        <select name="type" class="form-control m-input {{ $errors->has('type') ? 'is-danger' : '' }} ">
                                                <option value="virtual">
                                                    Virtual
                                                </option>
                                                <option value="face-to-face">
                                                    Presencial
                                                </option>
                                        </select> 
                                    </div>
                                    @error('type')
                                        <div class="text-red">{{ $errors->first('type') }}</div>
                                    @enderror 
                                </div>
                                <div class="form-group m-form__group">
                                    <label>Link</label>
                                    <input type="text" name="link" class="form-control m-input" value="{{ old('link') }}" placeholder="Udemy.com" autocomplete="off" minlength="3" maxlength="50">   
                                </div>
                                <div class="form-group m-form__group">
                                    <label>Lugar</label>
                                    <input type="text" name="place" class="form-control m-input" value="{{ old('place') }}" placeholder="Escuela - laboratorio 1" autocomplete="off" minlength="3" maxlength="50">  
                                </div>
                                <div class="form-group m-form__group">
                                    <label>Objetivo del curso</label>
                                    <input type="text" name="objective" class="form-control m-input {{ $errors->has('objective') ? 'is-danger' : '' }} " value="{{ old('objective') }}" placeholder="Escuela - laboratorio 1" autocomplete="off" minlength="3" maxlength="50"> 
                                        @error('objective')
                                            <div class="text-red">{{ $errors->first('objective') }}</div>
                                        @enderror   
                                </div>
                                <div class="form-group m-form__group">
                                    <label>Contenido</label>
                                    <textarea name="content" class="form-control m-input {{ $errors->has('content') ? 'is-danger' : '' }} " autocomplete="off">{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="text-red">{{ $errors->first('content') }}</div>
                                        @enderror   
                                </div>
                                <div class="m-form__group">
                                    <label>Fecha del curso</label>
                                    <div class="form-inline">
                                        <input type="date" name="start_course" class="form-control m-input {{ $errors->has('start_course') ? 'is-danger' : '' }} "> &nbsp; &nbsp;
                                        <input type="date" name="end_course" class="form-control m-input {{ $errors->has('end_course') ? 'is-danger' : '' }} "> 
                                    </div>
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

@endsection

@section('customScripts')
<script>
@if(session('message'))
    $('#message').fadeIn();
    $('#message').fadeOut(5000);

@endif
</script>
@endsection