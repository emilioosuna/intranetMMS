@extends('adminlte::page')

@section('template_title')
    Editar Asesor
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
                        <span class="card-title">{{ __('Editar') }} Asesor</span>
                        <div class="float-right">
                            <a class="btn bg-dark btn-sm" href="{{ route('vendedores.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('vendedores.update', $vendedore->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('vendedore.form')

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
