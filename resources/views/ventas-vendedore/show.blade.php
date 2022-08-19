@extends('adminlte::page')

@section('template_title')
    {{ 'Ver Venta Vendedores Periodo' }}
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;">
<h3 class="widget-user-username text-right" style="color: black;"><b> Ver Venta Vendedores Sistema</b></h3>
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
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Ventas Vendedore</span>
                        </div>
                        <div class="float-right">
                            <a class="btn-sm bg-dark" href="{{ route('ventas-vendedores.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Tienda</strong>
                                    {{ $ventasVendedore->tienda }}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Fdesde:</strong>
                                    {{ $ventasVendedore->fdesde }}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <strong>Fdhasta:</strong>
                                    {{ $ventasVendedore->fdhasta }}
                                </div>
                            </div>
                        </div>
                        <div id="accordion">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                            <h7>Detalle Vendedores Periodo </h7>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                       <table id="datatable" class="table table-striped table-bordered dt-responsive " style="width:100%">
                                            <thead class="thead">
                                                <tr>
                                                    <th>Vendedor</th>
                                                    <th>Monto</th>
                                                    <th>Unidades</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($vvdetalle as $ventasVendedor)
                                                    <tr>
                                                        <td>{{ $ventasVendedor->vendedor }}</td>
                                                        <td>{{ $ventasVendedor->montob }}</td>
                                                        <td>{{ $ventasVendedor->vunidades }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-green">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                            <h7>Grafico Vendedores Periodo </h7>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <figure class="highcharts-figure">
                                            <div id="container1"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-orange">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                            <h7 style="color:white;">Grafico Vendedores Unidades Periodo </h7>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <figure class="highcharts-figure">
                                            <div id="container2"></div>
                                        </figure>
                                    </div>
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
<script src="{{ asset('highcharts/code/modules/series-label.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/exporting.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/export-data.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/accessibility.js') }}"></script>
{{-- /* Graficos */ --}}
<script type="text/javascript">
Highcharts.chart('container1', {
chart: {
    type: 'column'
  },
  title: {
    text: 'Ventas Generales MS.'
  },
  subtitle: {
    text: 'Source: {{ $ventasVendedore->tienda }} '
  },
  xAxis: {
    categories: [
      @foreach ($vvdetalle as $record)
                {!!  "'".$record->vendedor."'".',' !!}
      @endforeach
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'USD ($)'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} USD</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [{
    name: 'Ventas USD',
    color: 'green',
    data: [
         @foreach ($vvdetalle as $record)
                    {!!  $record->montob.',' !!}
         @endforeach
    ]

  }]
});
</script>
<script type="text/javascript">
Highcharts.chart('container2', {
chart: {
    type: 'column'
  },
  title: {
    text: 'Ventas Unidades MS.'
  },
  subtitle: {
    text: 'Source: {{ $ventasVendedore->tienda }} '
  },
  xAxis: {
    categories: [
      @foreach ($vvdetalle as $record)
                {!!  "'".$record->vendedor."'".',' !!}
      @endforeach
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'UNIDADES'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} UND</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [{
    showInLegend: false,
    name: 'Ventas Unidades',
    color: 'orange',
    data: [
         @foreach ($vvdetalle as $record)
                    {!!  $record->vunidades.',' !!}
         @endforeach
    ]

  }]
});
</script>
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
<script>
$(function () {
    $('#datatable').DataTable({
          'responsive'  : true,
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : true,
           dom: 'Bfrtip',
            buttons: [
                //'excel', 'pdf', 'print'
                {
                    extend: 'print',
                    text:'<i class="fas fa-print"></i> Imprimir',
                    className: 'btn btn-secondary btn-sm fbuttons sombra',
                    title:'{{ $ventasVendedore->tienda.' - Detalle Vendedores Periodo '  }}<br> Desde: {{ $ventasVendedore->fdesde }} Hasta: {{ $ventasVendedore->fdhasta }}',
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' )
                            .prepend(
                                '<img src="{{asset('logo_cmedical.png') }}" style="position:absolute; top:260px; left:200px; opacity: 0.2;" width="600vw;"/>'
                            );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );

                    }

                },
                {
                    extend: 'excel',
                    text:'<i class="fas fa-print"></i> Excel',
                    className: 'btn btn-secondary btn-sm fbuttons sombra',
                    title:'{{ $ventasVendedore->tienda.' - Detalle Vendedores Periodo '  }}',
                    messageTop: 'Desde: {{ $ventasVendedore->fdesde }} Hasta: {{ $ventasVendedore->fdhasta }}',


                },
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    text:'<i class="fas fa-print"></i> PDF',
                    className: 'btn btn-secondary btn-sm fbuttons sombra',
                    title: '{{ $ventasVendedore->tienda.' - Detalle Vendedores Periodo '  }}' + '\n' +'Desde: {{ $ventasVendedore->fdesde }} Hasta: {{ $ventasVendedore->fdhasta }}',

                    customize: function ( doc ) {
                       var cols = [];
                       cols[0] = {text: 'INTRANET MultimaxStore', alignment: 'left', margin:[20] };
                       var objFooter = {};
                       objFooter['columns'] = cols;
                       doc['footer']=objFooter;
                       doc.styles.tableHeader.alignment = 'left';
                       doc.pageMargins = [20, 15, 25,20];
                       doc.content[1].table.widths = ['*',80,80];

                    },
                     pageSize : 'LETTER'
                }
            ],
           language: {
              url: "{{ asset('.spanish.json') }}"
           }
    });
    $('#datatable').DataTable()
      setTimeout(function() {
        $(".msg").fadeOut(500);
    },3000);
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
