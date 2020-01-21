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
                        
                        <form class="m-form m-form--fit m-form--label-align-left">
                        @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                <label for="">Hola</label>
                                    <input type="text" class="form-control m-input"  placeholder="Filtar ..">      
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')

@endsection