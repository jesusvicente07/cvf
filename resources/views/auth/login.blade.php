@extends('layouts.app')

@section('content')

    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(../img/misc/login-bg.jpg);">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                            <img src="../img/logo/logo-1.png">
                    </div>
                      <!-- Nav tabs -->
                    <ul class="nav">
                        <li class="nav-item" style="display:none">
                            <a class="nav-link" id="return" href="#"> << Regresar</a>
                        </li>
                    </ul>
                    <div id="user" class="container"><br>
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="m-login__title">Selecionar Usuario</h3>
                            </div>
                            <div class="m-login__form m-form">
                                <div class="form-group">
                                    <select name="selectUser" class="form-control">
                                        <option value="" selected>Selecionar</option>
                                        <option value="coordinator">Coordinador</option>
                                        <option value="student">Estudiante</option>
                                    </select>
                                    <span class="invalid-feedback" style="display:none" role="alert">
                                            <strong>Es requerido selecionar un usuario</strong>
                                    </span>
                                </div>
                                <div class="m-login__form-action">
                                    <button id="next"  class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Siguiente</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="login" class="container" style="display:none"><br>
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="m-login__title">{{ __('Ingresar') }}</h3>
                            </div>
                            <form class="m-login__form m-form" id="form_login" method="POST" action="#">
                                @csrf
                                <div class="form-group m-form__group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electrónico">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group m-form__group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="row m-login__form-sub">
                                    <div class="col m--align-left m-login__form-left">
                                        <label class="m-checkbox  m-checkbox--focus">
                                            <input type="checkbox" name="remember"> Remember me
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col m--align-right m-login__form-right">
                                        <a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>
                                    </div>
                                </div>
                                <div class="m-login__form-action">
                                    <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">{{ __('Ingresar') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="m-login__account">
                            <span class="m-login__account-msg">
                                Don't have an account yet ?
                            </span>&nbsp;&nbsp;
                            <a href="/register" id="m_login_signup" class="m-link m-link--light m-login__account-link">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        
        $('#next').click(function(){
            if($("select[name='selectUser']").val()){
                $('#user').hide();
                switch($("select[name='selectUser']").val()){
                    case 'coordinator':
                    $('#form_login').attr('action', 'login');
                        break;
                    case 'student':
                    $('#form_login').attr('action', 'estudiantes/login');                       
                     break;
                    case 'admin':
                    $('#form_login').attr('action', 'login');                        
                    break;
                }
                $('.nav-item').show();
                $('#login').show();
            }else{
                $("select[name='selectUser']").addClass('is-invalid');
                $('.invalid-feedback').show();
            }
        });
        $('#return').click(function(){
            $('.nav-item').hide();
            $("select[name='selectUser']").removeClass('is-invalid');
            $('.invalid-feedback').hide();
            $('#login').hide();
            $('#user').show();
        });

    });
    </script>
    
