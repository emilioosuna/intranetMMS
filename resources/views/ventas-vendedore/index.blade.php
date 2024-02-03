@extends('adminlte::page')
@section('title', 'Usuarios Sistema')
@section('template_title')
    Registros de Ventas Vendedores MultimaxStore
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;background-size: 100% 100%;">
<h3 class="widget-user-username text-right" style="color: black;"><b> Ventas Vendedores Sistema</b></h3>
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
                                {{ __('Ventas Vendedores') }}
                            </span>
                            @can('ventas.create')
                             <div class="float-right">
                                <a href="{{ route('ventas-vendedores.create') }}" class="btn bg-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Registrar') }}
                                </a>
                                <a  href="{{ asset('Fventas_vendedores.csv') }}" download="FVentasVendedores"  style="margin-right: 5px;">
                                     <button class="btn btn-sm bg-dark" type="button"><i class="fas fa-download"></i> CSV Formato</button>
                                </a>
                              </div>
                            @endcan
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
										<th>Desde</th>
										<th>Hasta</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ventasVendedores as $ventasVendedore)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $ventasVendedore->tienda }}</td>
											<td>{{ implode('/',array_reverse(explode('-', $ventasVendedore->fdesde )))}}</td>
											<td>{{ implode('/',array_reverse(explode('-', $ventasVendedore->fdhasta )))}}</td>

                                            <td>
                                                <form action="{{ route('ventas-vendedores.destroy',$ventasVendedore->id) }}" method="POST">
                                                    @can('ventas-vendedores.show')
                                                        <a class="btn btn-sm btn-primary " href="{{ route('ventas-vendedores.show',$ventasVendedore->id) }}"><i class="fa fa-fw fa-eye"></i> Inspeccionar</a>
                                                    @endcan
                                                    @can('ventas-vendedores.edit')
                                                        <a class="btn btn-sm btn-success" href="{{ route('ventas-vendedores.edit',$ventasVendedore->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @endcan
                                                        @csrf
                                                        @method('DELETE')
                                                    @can('ventas-vendedores.destroy')
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
                {{-- {!! $ventasVendedores->links() !!} --}}
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
