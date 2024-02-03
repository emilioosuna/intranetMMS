@extends('adminlte::page')

@section('template_title')
    {{ 'Ver Gestion Asesor' }}
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;">
<h3 class="widget-user-username text-right" style="color: black;"><b>Ver Gestion Asesor</b></h3>
</div>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/personal.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endsection
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-3">

                <div class="card card-info card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset($vendedore->imagen) }}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center"><span>{{ strtoupper($vendedore->nombre) }}</span></h3>
                        <p class="text-muted text-center"><b>ASESOR DE VENTAS</b></p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                @php
                                    $acumulados=collect($dataano)->sum('canfac');
                                @endphp
                                <b>Record Asistencias Acumuladas</b> <a class="float-right">{{ $acumulados }}</a>
                            </li>
                            <li class="list-group-item">
                                {{--  @php
                                    date_default_timezone_set("America/Caracas");

                                    setlocale(LC_ALL,'es-ES');
                                    $mes=strtolower(date('F'));
                                    dd($mes);
                                    foreach (collect($dataano) as $value) {
                                        dd($value->mes);
                                    }
                                    $mesactu=collect($dataano)->sum('canfac');
                                @endphp --}}
                                <b>Record Asistencias Mes Actual</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                 @php
                                    $mesante=collect($dataano)->sum('canfac');
                                @endphp
                                <b>Record Asistencias Mes Anterior</b> <a class="float-right">13,287</a>
                            </li>
                             <a class="btn btn-primary" href="{{ route('vendedores.index') }}"> {{ __('Volver') }}</a>
                        </ul>
                    </div>
                </div>


                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">DETALLES</h3>
                    </div>

                    <div class="card-body">
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Tienda</strong>
                        <p class="text-muted">Guanare, Portuguesa</p>
                        <hr>
                        <strong><i class="fas fa-pencil-alt mr-1"></i> Detalles Asesor(a)</strong>
                        <hr>
                        <p class="text-muted">
                            <span class="tag tag-danger">Correo: <b>{{ $vendedore->correo??'' }}</b> </span>
                        </p>
                        <hr>
                        <p class="text-muted">
                            <span class="tag tag-danger">Telefono: <b>{{ $vendedore->telefono??'' }}</b> </span>
                        </p>
                        {{-- <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> --}}
                    </div>

                </div>

            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active bg-info" href="#activity" data-toggle="tab">GESTION</a></li>
                            <li>
                                <select name="anoges" id="anoges" class="form-control">
                                    {{-- <option value="{{ date("Y") }}" selected>{{ date("Y") }}</option> --}}
                                    @foreach ($dyear as $element)
                                        <option value="{{ $element->year }}" {{ ($element->year ==($year!=NULL?$year:date('Y'))) ? "selected" : "" }}>{{ $element->year }}</option>
                                    @endforeach
                                </select>
                            </li>
                        </ul>

                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <figure class="highcharts-figure">
                                    <div id="container"></div>
                                </figure>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
@section('footer')
@include('footer')
@stop
@push('js')
<script src="{{ asset('highcharts/code/highcharts.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/data.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/drilldown.js') }}"></script>
{{-- <script src="{{ asset('highcharts/code/modules/series-label.js') }}"></script> --}}
<script src="{{ asset('highcharts/code/modules/exporting.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/export-data.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/accessibility.js') }}"></script>

<script>
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'GESTION ASESOR '
    },
    subtitle: {
        align: 'left',
        text: 'GUANARE - MULTIMAX STORE'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Asistencias'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> total<br/>'
    },

    series: [
        {
            name: 'ASISTENCIAS',
            colorByPoint: true,
            data: [
                // {
                //     name: 'Chrome',
                //     y: 63.06,
                //     drilldown: 'Chrome'
                // },
                @foreach ($dataano as $element)
                 {
                    name: '{{ strtoupper($element->mes) }}',
                    y: {{ $element->canfac }},
                    drilldown: '{{ strtoupper($element->mes) }}'
                },
                @endforeach
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            // {
            //     name: 'Chrome',
            //     id: 'Chrome',
            //     data: [
            //         [
            //             'v65.0',
            //             0.1
            //         ],

            //     ]
            // },
            // {
            //     name: 'Firefox',
            //     id: 'Firefox',
            //     data: [
            //         [
            //             'v58.0',
            //             1.02
            //         ],
            //     ]
            // },
            @foreach ($datadd->groupBy('mes') as $key => $value)
               {
                    name: '{{ strtoupper($key) }}',
                    id: '{{ strtoupper($key) }}',
                    data:[
                        @foreach ($value as $element)
                            [
                                '{{ $element->fdesde }}',
                                {{ $element->canfac }}
                            ],
                        @endforeach
                    ]
               },
            @endforeach
        ]
    }
});
$(function () {
 $('#anoges').change(function () {
        var year = $(this).val();
            $(location).attr('href','/vendedores/'+{{ $vendedore->id }}+'/'+year);
    });

  });
</script>

{{-- Bootstrap 4 --}} {{-- Javascript --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

{{-- Bootstrap 4 styling --}} {{-- Para el Responsive --}}
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

{{-- PARA EXPORTAR A EXCEL PDF Y/O IMPRIMIR LOS DATABLES DIRECTOS DESDE UN HTML --}}
<script src="{{ asset('js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('js/jszip.min.js')}}"></script>
<script src="{{ asset('js/jszip.min.js')}}"></script>
<script src="{{ asset('js/pdfmake.min.js')}}"></script>
<script src="{{ asset('js/vfs_fonts.js')}}"></script>
<script src="{{ asset('js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('js/buttons.print.min.js')}}"></script>
@endpush
