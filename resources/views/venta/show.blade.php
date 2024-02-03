@extends('adminlte::page')

@section('template_title')
    {{ 'Ver Venta' }}
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;background-size: 100% 100%;">
<h3 class="widget-user-username text-right" style="color: black;"><b> Ver Venta Sistema</b></h3>
</div>
</div>
@stop
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Venta</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm bg-dark"  href="{{ route('ventas.index') }}">Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                            <div class="col-lg-12 ">
                                <div class="row">
                                        <div class="form-group col-lg-4">
                                        <strong>Tienda:</strong>
                                        {{ $venta->tienda }}
                                    </div>
                                    <div class="form-group  col-lg-4">
                                        <strong>Fventa:</strong>
                                      {{ implode('/',array_reverse(explode('-',$venta->fventa )))}}
                                    </div>
                                    <div class="form-group  col-lg-4">
                                        <strong>Fregistro:</strong>
                                      {{ implode('/',array_reverse(explode('-',$venta->fregistro )))}}
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="form-group col-lg-4">
                                        <strong>Contado:</strong>
                                        {{ $venta->contado }}
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <strong>Credito:</strong>
                                        {{ $venta->credito }}
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <strong>Total Ventas:</strong>
                                        {{ $venta->credito + $venta->contado }}
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="form-group  col-lg-4">
                                        <strong>Linea Blanca:</strong>
                                        {{ $venta->linea_blanca }}
                                    </div>
                                    <div class="form-group  col-lg-4">
                                        <strong>Linea Menor:</strong>
                                        {{ $venta->linea_menor }}
                                    </div>
                                    <div class="form-group  col-lg-4">
                                        <strong>Linea Marron:</strong>
                                        {{ $venta->linea_marron }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group  col-lg-4">
                                        <strong>Aire Acondicionados:</strong>
                                        {{ $venta->aire_acondicionados }}
                                    </div>
                                    <div class="form-group  col-lg-4">
                                        <strong>Celulares:</strong>
                                        {{ $venta->celulares }}
                                    </div>
                                    <div class="form-group  col-lg-4">
                                        <strong>Otros:</strong>
                                        {{ $venta->otros }}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-lg-12">
                                <div class="card card-primary">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">Grafica Ventas por Productos </h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <figure class="highcharts-figure">
                                            <div id="container1"></div>
                                        </figure>
                                    </div>
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
<script src="{{ asset('highcharts/code/highcharts-3d.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/series-label.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/exporting.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/export-data.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/accessibility.js') }}"></script>
{{-- /* Graficos */ --}}
<script type="text/javascript">
Highcharts.chart('container1', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: 'Ventas Productos del Día'
    },
    subtitle: {
       text: 'Source: {{ $venta->tienda }} '
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'Unidades Vendidas',
        data: [
            ['Linea Blanca', {{ $venta->linea_blanca }}],
            ['Linea Menor', {{ $venta->linea_menor }}],
            ['Linea Marron', {{ $venta->linea_marron }}],
            ['Aires Acondicionados', {{ $venta->aire_acondicionados }}],
            ['Celulares',{{ $venta->celulares }}],
            ['otros', {{ $venta->otros }}]
        ]
    }]
});
</script>

@endpush
