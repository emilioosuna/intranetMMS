@extends('adminlte::page')
@section('title', ' Crear Usuario')
@section('plugins.Select2',true)
@section('template_title')
    Crear Usuario
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;background-size: 100% 100%;">
<h3 class="widget-user-username text-right" style="color: black;"><b> Crear Usuarios </b></h3>
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
                           <span id="card_title">
                                {{ __('Crear Usuario') }}
                            </span>
                          <div class="float-right">
                            <a class="btn bg-dark"  href="{{ route('users.index') }}">Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('user.form')

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
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

     $.fn.populateSelect = function (values) {
        var options = '<option value=" ">' + '---' + '</option>';
        //var options = '';
        $.each(values, function (key, row) {
            options += '<option value="' + row.value + '">' + row.text + '</option>';
        });
        $(this).html(options);
    }
    // Busca los municipios del estado seleccionado
    $('#estado_id').change(function () {

        var id_estado = $(this).val();
        if (id_estado == '') {
            $('#municipio_id').empty().change();
            $('#parroquia_id').empty().change();
        } else {
            $.getJSON('/municipio/'+id_estado, null, function (values) {
                $('#municipio_id').populateSelect(values);
            });
             $('#parroquia_id').empty().change();
        }
    });
    // Busca las parroquias del municipio seleccionado
    $('#municipio_id').change(function () {
        var id_municipio = $(this).val();
        if (id_municipio == '') {
            $('#parroquia_id').empty().change();
        } else {
            $.getJSON('/parroquia/'+id_municipio, null, function (values) {
                $('#parroquia_id').populateSelect(values);
            });
        }
    });


   });
  $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('cpassword').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = '';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Clave no coincide';
  }
}
</script>
@endpush
