@extends('adminlte::page')

@section('template_title')
    Editar Venta Vendedores
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;">
<h3 class="widget-user-username text-right" style="color: black;"><b> Editar Venta Sistema</b></h3>
</div>
</div>
@stop
@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-info">
                    <div class="card-header">
                        <span class="card-title">Editar Venta Periodo</span>
                           <div class="float-right">
                            <a class="btn btn-sm bg-dark"  href="{{ route('facturas-vendedores.index') }}">Volver</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('facturas-vendedores.update', $facturasVendedore->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('facturas-vendedore.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
@include('footer')
@stop