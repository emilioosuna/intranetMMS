@extends('adminlte::page')
@section('title', 'Usuarios Sistema')
@section('template_title')
    Registros de Ventas MultimaxStore
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;">
<h3 class="widget-user-username text-right" style="color: black;"><b> Ventas Sistema</b></h3>
</div>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/personal.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __(' Registros de Ventas MultimaxStore') }}
                            </span>

                             <div class="float-right">
                                @can('ventas.create')
                                    <a href="{{ route('ventas.create') }}" class="btn bg-dark btn-sm float-righ"  data-placement="left">
                                        {{ __('Registrar') }}
                                    </a>
                                @endcan

                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive " style="width:100%">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>Tienda</th>
										<th>Fventa</th>
										<th>Fregistro</th>
										<th>Contado</th>
										<th>Credito</th>
										<th>L Blanca</th>
										<th>L Menor</th>
										<th>L Marron</th>
										<th>A/Acond</th>
										<th>Celulares</th>
										<th>Otros</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ventas as $venta)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $venta->tienda }}</td>
											<td>{{ $venta->fventa }}</td>
											<td>{{ $venta->fregistro }}</td>
											<td>{{ $venta->contado }}</td>
											<td>{{ $venta->credito }}</td>
											<td>{{ $venta->linea_blanca }}</td>
											<td>{{ $venta->linea_menor }}</td>
											<td>{{ $venta->linea_marron }}</td>
											<td>{{ $venta->aire_acondicionados }}</td>
											<td>{{ $venta->celulares }}</td>
											<td>{{ $venta->otros }}</td>

                                            <td>
                                                <form action="{{ route('ventas.destroy',$venta->id) }}" method="POST">
                                                    @can('ventas.show')
                                                        <a class="btn btn-sm btn-primary " href="{{ route('ventas.show',$venta->id) }}"><i class="fa fa-fw fa-eye"></i> Inspeccionar</a>
                                                    @endcan
                                                    @can('ventas.edit')
                                                        <a class="btn btn-sm btn-success" href="{{ route('ventas.edit',$venta->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @endcan
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('ventas.destroy')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- {!! $ventas->links() !!} --}}
            </div>
        </div>
    </div>
@endsection
@section('footer')
@include('footer')
@stop
@push('js')
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
                    title:'{{ 'Lista de Ventas Registradas' }}',
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' )
                            .prepend(
                                '<img src="{{asset('logo_cmedical.png') }}" style="position:absolute; top:260px; left:200px; opacity: 0.2;" width="600vw;"/>'
                            );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );

                        $(win.document.body).find( 'table' ).find('td:last-child, th:last-child').remove();
                    }

                },
                {
                    extend: 'excel',
                    text:'<i class="fas fa-print"></i> Excel',
                    className: 'btn btn-secondary btn-sm fbuttons sombra',
                    title:'{{ 'Lista de Ventas Registradas' }}',
                     exportOptions: {
                            // columns: ':visible' or
                            columns: 'th:not(:last-child)',

                        }

                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    download: 'open',
                    text:'<i class="fas fa-print"></i> PDF',
                    className: 'btn btn-secondary btn-sm fbuttons sombra',
                    title:'{{ 'Lista de Ventas Registradas' }}',
                   exportOptions: {
                        // columns: ':visible' or
                        columns: [0, 1, 2, 4, 5, 6, 7, 8, 9, 10, 11]
                        //columns: 'th:not(:last-child)',
                    },
                    customize: function ( doc ) {
                       var cols = [];
                       cols[0] = {text: 'INTRANET MultimaxStore', alignment: 'left', margin:[20] };

                       var objFooter = {};
                       objFooter['columns'] = cols;
                       doc['footer']=objFooter;
                       doc.styles.tableHeader.alignment = 'left'; //giustifica a sinistra titoli colonne
                       doc.pageMargins = [20, 15, 25,20];
                       doc.content[1].table.widths = [20,'*','*','*','*','*','*','*','*','*','*'];
                    //    doc.content.splice(0, 0,
                    //     {
                    //         margin: [0, 0, 0, 1],
                    //         alignment: 'center',
                    //         image: 'data:image/jpg;base64,...'
                    //     });
                    doc.styles.tableHeader.fontSize = 10;
                    doc.defaultStyle.fontSize = 8;
                    var rowCount = doc.content[1].table.body.length;
                        for (i = 1; i < rowCount; i++) {
                            doc.content[1].table.body[i][3].alignment = 'right';
                            doc.content[1].table.body[i][4].alignment = 'right';
                            doc.content[1].table.body[i][5].alignment = 'right';
                            doc.content[1].table.body[i][6].alignment = 'right';
                            doc.content[1].table.body[i][7].alignment = 'right';
                            doc.content[1].table.body[i][8].alignment = 'right';
                            doc.content[1].table.body[i][9].alignment = 'right';
                            doc.content[1].table.body[i][10].alignment = 'right';
                        }
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
