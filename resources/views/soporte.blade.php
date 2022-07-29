@extends('adminlte::page')

@section('title', 'Soporte')

@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;">
<h3 class="widget-user-username text-right" style="color: black;"><b>SOPORTE</b></h3>
</div>
</div>
@stop
@section('content')
    <div class="card card-info">
    <div class="card-header">
       <h3 class="card-title">INTRANET - MultimaxStore</h3>
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
                    @php
                    $p[1] = [
                        "frase" => "A menudo las personas están trabajando duro en la cosa equivocada. Trabajar en la cosa correcta probablemente es más importante que trabajar duro",
                        "autor" => "Caterina Fake",
                    ];
                    $p[2] = [
                        "frase" => "Mantente alejado de aquellas personas que tratan de menospreciar tus ambiciones. Las personas pequeñas siempre lo hacen, pero los verdaderamente grandes hacen sentirte que tú también puedes ser grande",
                        "autor" => "Mark Twain",
                    ];
                    $p[3] = [
                        "frase" => "El éxito es la suma de pequeños esfuerzos repetidos un día sí y otro también",
                        "autor" => "Robert Collier",
                    ];
                    $p[4] = [
                        "frase" => "Nada es particularmente difícil si lo divides en pequeños trabajos",
                        "autor" => "Henry Ford",
                    ];
                    $p[5] = [
                        "frase" => "He aprendido que los errores pueden ser tan buenos profesores como el éxito",
                        "autor" => "Jack Welch",
                    ];
                    $p[6] = [
                        "frase" => "Trabajar es lo que nos mantiene vivos, sin nuestro trabajo, no seríamos más que seres sin metas en la vida",
                        "autor" => "Anónimo",
                    ];
                    $p[7] = [
                        "frase" => "La motivación nos impulsa a comenzar y el hábito nos permite continuar",
                        "autor" => "Jim Ryun",
                    ];
                    $p[8] = [
                        "frase" => "Escoge un trabajo que te guste, y nunca tendrás que trabajar ni un solo día de tu vida",
                        "autor" => "Confucio",
                    ];
                    $p[9] = [
                        "frase" => "El trabajo que nunca se empieza es el que tarda más en finalizarse",
                        "autor" => "J.R.R. Tolkien",
                    ];
                    $p[10] = [
                        "frase" => "El éxito no se logra sólo con cualidades especiales. Es sobre todo un trabajo de constancia, de método y de organización",
                        "autor" => "Víctor Hugo",
                    ];
                    $i = rand(1, 10);
                    @endphp
                   
                    <blockquote style="position: relative;">
                     <p style="text-align: justify;"> "Herramienta de Control de registro y movimientos de operaciones e INTRANET de <b>MultimaxStore</b>"</p>
                        <blockquote class="pull-right" style="position: relative;">
                            <p style="text-align: justify;">{{ '"' . ($p[$i]["frase"]) . '"'}}</p>
                            <small><cite title="Source Title"><b>{{ ($p[$i]["autor"]) }}</b></cite></small>
                        </blockquote>
                    </blockquote>
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
var _smartsupp = _smartsupp || {};
        _smartsupp.key = 'dd62a6c1692a94e530778bd1a0930f5e7a87effe';
        
        window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
     })(document);

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
