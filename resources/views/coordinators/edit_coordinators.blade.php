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
                        
                        <form action="{{ route('updatecoordinators',$coordinator) }}" method="POST" class="m-form m-form--fit m-form--label-align-left" style="text-align:left">
                        @csrf
                        @method('PUT')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    @if(session('message'))
                                        <div class="alert alert-success alert-dismissible" id="message">
                                            {{session('message')}}                                        
                                        </div>
                                    @endif
                                    <label>Nombre</label>
                                    <input type="text" name="name" class="form-control m-input {{ $errors->has('name') ? 'is-danger' : '' }} "  placeholder="Jesus Vicente" value="{{ $coordinator->name }}" autocomplete="off">
                                    @error('name')
                                      <div class="text-red">{{ $errors->first('name') }}</div>
                                    @enderror
                                </div>
                                <div class="form-group m-form__group">      
                                    <label>Correo</label>
                                    <input type="text" name="email" class="form-control m-input {{ $errors->has('email') ? 'is-danger' : '' }} "  placeholder="example@gmail.com" value="{{ $coordinator->email }}" autocomplete="off">
                                    @error('email')
                                      <div class="text-red">{{ $errors->first('email') }}</div>
                                    @enderror 
                                </div>    
                                <div class="form-group m-form__group">
                                    <label>Contraseña</label>
                                    <input type="text" name="password" class="form-control m-input {{ $errors->has('password') ? 'is-danger' : '' }} "  placeholder="********"  autocomplete="off">
                                    @error('password')
                                      <div class="text-red">{{ $errors->first('password') }}</div>
                                    @enderror  
                                </div>
                                <div class="m-form__group"> <label>Carrera</label>
                                    <div class="form-inline">
                                        <select name="careers" class="form-control m-input {{ $errors->has('careers') ? 'is-danger' : 'careers' }} ">
                                            @foreach($careers as $career)
                                                @if(!$career->user_id || $career->user_id ==  $coordinator->id)
                                                    <option value="{{$career->id}}" {{ $career->user_id == $coordinator->id ? 'selected' : '' }} >
                                                        {{$career->name}}
                                                    </option>
                                                @endif
                                            @endforeach
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
<script>
@if(session('message'))
    $('#message').fadeIn();
    $('#message').fadeOut(5000);

@endif
</script>
@endsection