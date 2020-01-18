@extends('layouts.admin')
@section('title', 'Cvf')

@section('customStyles')

@endsection

@section('content')
    <!-- END: Subheader -->
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
                                            Crear nueva práctica
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Contenido -->
                            <form action="" method="POST" class="m-form m-form--fit m-form--label-align-right" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label>Título de la práctica</label>
                                        <span class="m-form__help"></span>
                                        <input type="text" class="form-control m-input" id="txtTitulo" name="titulo" placeholder="e.g. Comprobando la transferencia de calor">
                                    </div>
                                    
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')

@endsection