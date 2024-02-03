@extends('adminlte::page')
@section('title', 'Usuarios Sistema')
@section('template_title')
    Usuarios Sistema
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/personal.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;background-size: 100% 100%;">
<h3 class="widget-user-username text-right" style="color: black;"><b> Usuarios Sistema</b></h3>
</div>
</div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Usuarios') }}
                            </span>

                             <div class="float-right">
                                 @can('users.create')
                                    <a href="{{ route('users.create') }}" class="btn bg-dark btn-sm float-righ"  data-placement="left">
                                        {{ __('Crear') }}
                                    </a>
                                @endcan

                              </div>
                        </div>
                    </div>
                    @foreach (['danger', 'warning', 'success', 'info'] as $key)
                     @if(Session::has($key))
                     <div class="alert alert-{{ $key }} msg">
                            <button type="buttom" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Información</b>
                            <ul>
                               <li>{{ Session::get($key) }}</li>
                            </ul>
                        </div>
                     @endif
                    @endforeach

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive " style="width:100%">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Name</th>
										<th>Email</th>
										<th>Nivel</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->nivel }}</td>

                                            <td>
                                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                    @can('users.show')
                                                        <a class="btn btn-sm btn-primary sombra" href="{{ route('users.show',$user->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    @endcan
                                                    @can('users.edit')
                                                        <a class="btn btn-sm btn-success sombra" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @endcan
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('users.destroy')
                                                        <button type="submit" class="btn btn-danger btn-sm sombra"><i class="fa fa-fw fa-trash"></i> Borrar</button>
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
                {{-- {!! $users->links() !!} --}}
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
                    title:'{{ 'Lista de Usuarios' }}',
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
                    title:'{{ 'Lista de Usuarios' }}',
                     exportOptions: {
                            // columns: ':visible' or
                            columns: 'th:not(:last-child)',

                        }

                },
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    text:'<i class="fas fa-print"></i> PDF',
                    className: 'btn btn-secondary btn-sm fbuttons sombra',
                    title:'{{ 'Lista de Usuarios' }}',
                    // orientation: 'landscape',
                   // pageSize: 'LEGAL',
                   exportOptions: {
                        // columns: ':visible' or
                        columns: 'th:not(:last-child)',
                    },
                    customize: function ( doc ) {
                       var cols = [];
                       cols[0] = {text: 'INTRANET MultimaxStore', alignment: 'left', margin:[20] };

                       var objFooter = {};
                       objFooter['columns'] = cols;
                       doc['footer']=objFooter;
                       doc.styles.tableHeader.alignment = 'left'; //giustifica a sinistra titoli colonne
                       doc.pageMargins = [20, 15, 25,20];
                       doc.content[1].table.widths = [20,'*','*','*'];
                    //    doc.content.splice(0, 0,
                    //     {
                    //         margin: [0, 0, 0, 1],
                    //         alignment: 'center',
                    //         image: 'data:image/jpg;base64,...'
                    //     });
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

