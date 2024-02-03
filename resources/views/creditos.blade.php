@extends('adminlte::page')

@section('title', 'Créditos')

@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;background-size: 100% 100%;">
<h3 class="widget-user-username text-right" style="color: black;"><b>CREDITOS</b></h3>
</div>
</div>
@stop
@section('content')
    <div class="card card-info">
    <div class="card-header">
       <h3 class="card-title">Programación y Diseño</h3>    
    </div>
    <form
          method="POST" class="guardar-datos"
          autocomplete="off"
          accept-charset="utf-8">   
        <div class="card-body">
            @csrf                    
            <div class="row">            
              <div class="col-sm-12"> 
                <div class="form-group">
                  <a href="http://emilioosuna.github.io" target="blank" style="color:black;">
                    <h5>Emilio Osuna:</h5>
                  </a>
                  <p>Programador - Diseñador Web | <i class="fas fa-phone"></i>  +58 412 4856185 | <i class="fas fa-envelope"></i>  ejohe54@gmail.com - asinconve@gmail.com</p><br>
                 {{--  <p><a href="http://asincon.com" target="blank"><img src="{{ asset('img/basincon.png') }}" alt="" width="60%"></a></p> --}}
                </div>
              </div>
            </div>            
        </div>       
    </form>
</div>
@include('footer')
@stop{{-- fin del content --}}
{{-- Test Sweetalert2 Plugin --}}
@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>    
<script>  
/*Rutina para bloquear el boton de atras del Navegador */
window.onload = function () {
      if (typeof history.pushState === "function") 
          {
            history.pushState("jibberish", null, null);
            window.onpopstate = function () {
            history.pushState('newjibberish', null, null);
          };
          form1.cedula.focus();
      }else {
          var ignoreHashChange = true;
          window.onhashchange = function ()
           {
              if (!ignoreHashChange) {
                  ignoreHashChange = true;
              }
              else {
                  ignoreHashChange = false;   
              }
           };
      }
    }
</script>       
@endpush
