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
                                        Editar curso
                                    </h3>
                            </div>
                        </div>
                    </div>
                        
                        <form action="{{route('updatecourses',$course)}}" method="post" class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
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
                                <div class="form-group m-form__group">
                                    <label>Nombre</label>
                                    <input type="text" name="name" class="form-control m-input {{ $errors->has('name') ? 'is-danger' : '' }} " value="{{$course->name}}" placeholder="e.g. Licenciatura en Psicología" autocomplete="off" minlength="3" maxlength="50"> 
                                        @error('name')
                                            <div class="text-red">{{ $errors->first('name') }}</div>
                                        @enderror   
                                </div>
                                <div class="m-form__group"> 
                                    <label>Tipo</label>
                                    <div class="form-inline">
                                        <select name="type" class="form-control m-input {{ $errors->has('type') ? 'is-danger' : '' }} ">    
                                                <option value="virtual" {{$course->type == 'virtual' ? 'selected' : ''}}>
                                                    Virtual
                                                </option>
                                                <option value="face-to-face" {{$course->type == 'face-to-face' ? 'selected' : ''}}>
                                                    Presencial
                                                </option>
                                        </select> 
                                    </div>
                                    @error('type')
                                        <div class="text-red">{{ $errors->first('type') }}</div>
                                    @enderror 
                                </div>
                                <div class="form-group m-form__group" id="link" style="display:{{ !$course->link ? 'none' : 'block' }}" >
                                    <label>Link</label>
                                    <input type="text" name="link" class="form-control m-input" value="{{$course->link}}" placeholder="Udemy.com" autocomplete="off" minlength="3" maxlength="50">   
                                </div>
                                <div class="form-group m-form__group">
                                    <label>Objetivo del curso</label>
                                    <input type="text" name="objective" class="form-control m-input {{ $errors->has('objective') ? 'is-danger' : '' }}" value="{{$course->objective}}" placeholder="objetivo" autocomplete="off" minlength="3" maxlength="50"> 
                                        @error('objective')
                                            <div class="text-red">{{ $errors->first('objective') }}</div>
                                        @enderror   
                                </div>
                                <div class="form-group m-form__group">
                                    <label>Contenido</label>
                                    <textarea name="content" class="form-control m-input {{ $errors->has('content') ? 'is-danger' : '' }} " autocomplete="off">{{$course->content}}</textarea>
                                        @error('content')
                                            <div class="text-red">{{ $errors->first('content') }}</div>
                                        @enderror   
                                </div>
                                <div class="m-form__group" id="duracion" style="display:{{ !$course->link ? 'none' : 'block' }}"> 
                                    <label>Duración</label>
                                    <div class="form-inline">
                                        <select name="duration" class="form-control m-input">
                                                <option value="" {{$course->duration == '' ? 'selected' : ''}}>
                                                    Selecionar
                                                </option>
                                                <option value="10-D" {{$course->duration == '10-D' ? 'selected' : ''}}>
                                                    10 días
                                                </option>
                                                <option value="15-D" {{$course->duration == '15-D' ? 'selected' : ''}}>
                                                    15 días
                                                </option>
                                                <option value="20-D" {{$course->duration == '20-D' ? 'selected' : ''}}>
                                                    20 días
                                                </option>
                                                <option value=" 25-D" {{$course->duration == '25-D' ? 'selected' : ''}}>
                                                    25 días
                                                </option>
                                                <option value="30-D" {{$course->duration == '30-D' ? 'selected' : ''}}>
                                                    30 días
                                                </option>
                                        </select> 
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

$(document).ready(function(){
  $("select[name='type']").change(function(){
      if($(this).val() == 'virtual'){
          $('#link').show();
          $("input[name='link']").attr("required", true);
          $('#duracion').show();
          $("select[name='duration']").attr("required", true);
      }
      else{
        $('#link').hide();
        $("input[name='link']").attr("required", false);
        $('#duracion').hide();
        $("select[name='duration']").attr("required", false);
      }
  });
});
</script>
@endsection