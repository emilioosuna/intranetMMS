@extends('adminlte::page')

@section('template_title')
    {{ 'Ver Venta' }}
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;">
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
                        
                        <div class="form-group">
                            <strong>Tienda:</strong>
                            {{ $venta->tienda }}
                        </div>
                        <div class="form-group">
                            <strong>Fventa:</strong>
                            {{ $venta->fventa }}
                        </div>
                        <div class="form-group">
                            <strong>Fregistro:</strong>
                            {{ $venta->fregistro }}
                        </div>
                        <div class="form-group">
                            <strong>Contado:</strong>
                            {{ $venta->contado }}
                        </div>
                        <div class="form-group">
                            <strong>Credito:</strong>
                            {{ $venta->credito }}
                        </div>
                        <div class="form-group">
                            <strong>Linea Blanca:</strong>
                            {{ $venta->linea_blanca }}
                        </div>
                        <div class="form-group">
                            <strong>Linea Menor:</strong>
                            {{ $venta->linea_menor }}
                        </div>
                        <div class="form-group">
                            <strong>Linea Marron:</strong>
                            {{ $venta->linea_marron }}
                        </div>
                        <div class="form-group">
                            <strong>Aire Acondicionados:</strong>
                            {{ $venta->aire_acondicionados }}
                        </div>
                        <div class="form-group">
                            <strong>Celulares:</strong>
                            {{ $venta->celulares }}
                        </div>
                        <div class="form-group">
                            <strong>Otros:</strong>
                            {{ $venta->otros }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
