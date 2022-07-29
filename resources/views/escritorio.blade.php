@extends('adminlte::page')
@section('title', 'Inicio')
@section('plugins.Sweetalert2',true)
@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('highcharts/code/css/highcharts.css') }}">
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;">
<h3 class="widget-user-username text-right" style="color: black;"><b>Multimax</b>Store</b></h3>
</div>
</div>
@stop
@section('content')

<div class="card card card-info">
    <div class="card-header">
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ventas General {{ $tienda }}</span>
                        <span class="info-box-number">{{  number_format($totalventa, 4, '.', ' ') }} <b>$</b></span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-dollar-sign"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ventas a Contado {{ $tienda }}</span>
                        <span class="info-box-number">{{  number_format($totalvcontado, 4, '.', ' ') }} <b>$</b></span>
                    </div>
                </div>
            </div>


            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-file-invoice"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ventas a Credito {{ $tienda }}</span>
                        <span class="info-box-number">{{  number_format($totalvcredito, 4, '.', ' ') }} <b>$</b></span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-info">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Ventas Registradas {{ $tienda }} </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container1"></div>
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card card-info">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Ventas por Productos {{ $tienda }} </h3>
                        </div>
                    </div>
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

@include('footer')
@stop
@section('js')
<script src="{{ asset('highcharts/code/highcharts.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/series-label.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/exporting.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/export-data.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/accessibility.js') }}"></script>
<script type="text/javascript">
Highcharts.chart('container1', {
chart: {
    type: 'column'
  },
  title: {
    text: 'Ventas Generales MS.'
  },
  subtitle: {
    text: 'Source: {{ $tienda }} '
  },
  xAxis: {
    categories: [
      @foreach ($dgrafventas as $record)
                {!!  "'".$record['abr']."'".',' !!}
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
      '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
    name: 'General',
    data: [
         @foreach ($dgrafventas as $record)
                    {!!  $record['tven'].',' !!}
         @endforeach
    ]

  }, {
    name: 'Contado',
    data: [
         @foreach ($dgrafventas as $record)
                    {!!  $record['tvcon'].',' !!}
         @endforeach
    ]

  }, {
    name: 'Credito',
    data: [
         @foreach ($dgrafventas as $record)
                    {!!  $record['tvcre'].',' !!}
         @endforeach
    ]

  }]
});
        </script>
        <script type="text/javascript">
// Radialize the colors
Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});

// Build the chart
Highcharts.chart('container2', {
   chart: {
    type: 'column'
  },
  title: {
    text: 'Ventas por Productos MS.'
  },
  subtitle: {
    text: 'Source: {{ $tienda }}'
  },
  xAxis: {
    categories: [
       @foreach ($dgrafventas2 as $record)
                {!!  "'".$record['abr']."'".',' !!}
      @endforeach
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Unidades (unds)'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:f} unds</b></td></tr>',
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
    name: 'Linea Blanca',
    data: [
         @foreach ($dgrafventas2 as $record)
                    {!!  $record['tlblan'].',' !!}
         @endforeach
    ]
  },{
    name: 'Linea Marron',
    data: [
         @foreach ($dgrafventas2 as $record)
                    {!!  $record['tlmar'].',' !!}
         @endforeach
    ]
  },{
    name: 'Linea Menor',
    data: [
         @foreach ($dgrafventas2 as $record)
                    {!!  $record['tlmen'].',' !!}
         @endforeach
    ]
  },{
    name: 'Aires Acondicionados',
    data: [
         @foreach ($dgrafventas2 as $record)
                    {!!  $record['taa'].',' !!}
         @endforeach
    ]
  }, {
    name: 'Celulares',
    data: [
         @foreach ($dgrafventas2 as $record)
                    {!!  $record['tcel'].',' !!}
         @endforeach
    ]
  }, {
    name: 'Otros',
    data: [
         @foreach ($dgrafventas2 as $record)
                    {!!  $record['totr'].',' !!}
         @endforeach
    ]
  }]
});
        </script>
@stop
