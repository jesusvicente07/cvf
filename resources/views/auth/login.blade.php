@extends('layouts.app')

@section('content')

    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(../img/misc/login-bg.jpg);">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo" style="margin-bottom: 0px;">
                            <img src="data:image/png;base64,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">
                    </div>

                    <div id="login" class="container"><br>
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="m-login__title">{{ __('Ingresar') }}</h3>
                            </div>
                            <form class="m-login__form m-form" id="form_login" method="POST" action="#">
                                @csrf
                                <div class="form-group">
                                    <label>Seleccionar usuario</label>
                                    <select name="selectUser" class="form-control">
                                        <option value="coordinator">Coordinador</option>
                                        <option value="student">Estudiante</option>
                                    </select>
                                </div>
                                <div class="form-group m-form__group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electrónico">

                                    @if(session('error'))
                                        <span style="color:red;font-size: 80%;">
                                            <strong>Estas credenciales no coinciden con nuestros registros.</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group m-form__group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="m-login__form-action">
                                    <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary" style="background-color:#006db6;border-color:#006db6;">{{ __('Ingresar') }}</button>
                                </div>
                            </form>
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
        $('#form_login').attr('action', 'users/login');
        $( "select[name='selectUser']" ).click(function() {
            switch($(this).val()){
                    case 'coordinator':
                    $('#form_login').attr('action', 'users/login');
                        break;
                    case 'student':
                    $('#form_login').attr('action', 'estudiantes/login');                       
                     break;
                    case 'admin':
                    $('#form_login').attr('action', 'users/login');                        
                    break;
            }
        });
        

    });
    </script>
    
