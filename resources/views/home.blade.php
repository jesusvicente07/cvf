@extends('layouts.admin')
@section('title', 'Curriculum Flexible')

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
                                            Gráfica Estudiantes-Carreras
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Contenido -->
                            <div class="m-form m-form--fit m-form--label-align-right">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Carrera 1', 'Carrera 2', 'Carrera 3', 'Carrera 4', 'Carrera 5', 'Carrera 6'],
        datasets: [{
            label: 'Estudiantes',
            data: [3, 7, 15, 6, 8, 13],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            width:[
                '10px'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endsection