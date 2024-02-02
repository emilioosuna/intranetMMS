@extends('adminlte::page')

@section('template_title')
    Create Asesores
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;">
<h3 class="widget-user-username text-right" style="color: black;"><b> Registrar Venta Sistema</b></h3>
</div>
</div>
@stop
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-info">
                    <div class="card-header">
                        <span class="card-title">{{ __('Registrar') }} Asesor</span>
                        <div class="float-right">
                            <a class="btn bg-dark btn-sm" href="{{ route('vendedores.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('vendedores.store') }}"  role="form" enctype="multipart/form-data">
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
@push('js')
<!-- InputMask -->
<script src="{{ asset('adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>

<script>
$(function () {
$('[data-mask]').inputmask()
    $('#cedula').inputmask('A99999999999999', { 'placeholder': '' });
    $('#telefono').inputmask('(0499)-9999999', { 'placeholder': '' });
});
</script>
@endpush
