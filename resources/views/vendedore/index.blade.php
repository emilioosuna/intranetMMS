@extends('adminlte::page')
@section('title', 'Vendedores (ASESORES) MultimaxStore')
@section('template_title')
    Registros de Vendedores (ASESORES) MultimaxStore
@endsection
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;background-size: 100% 100%;">
<h3 class="widget-user-username text-right" style="color: black;"><b> Vendedores (ASESORES) MultimaxStore</b></h3>
</div>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/personal.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Vendedores (ASESORES) MultimaxStore') }}
                            </span>

                             <div class="float-right">
                                @can('vendedores.create')
                                <a href="{{ route('vendedores.create') }}" class="btn bg-dark  btn-sm float-right"  data-placement="left">
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
                                        
										<th>Alias</th>
										<th>Codigo</th>
										<th>Cedula</th>
										<th>Nombre</th>
										<th>Telefono</th>
										<th>Correo</th>
										<th>Imagen</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendedores as $vendedore)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $vendedore->alias }}</td>
											<td>{{ $vendedore->codigo }}</td>
											<td>{{ $vendedore->cedula }}</td>
											<td>{{ $vendedore->nombre }}</td>
											<td>{{ $vendedore->telefono }}</td>
											<td>{{ $vendedore->correo }}</td>
											<td>{{-- {{ $vendedore->imagen }} --}}
                                                <a href="{{ asset($vendedore->imagen) }}" data-toggle="lightbox" data-title="{{ $vendedore->alias }}" data-gallery="gallery">
                                                    <img src="{{ asset($vendedore->imagen) }}" class="img-fluid " alt="{{ $vendedore->alias }}" >
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('vendedores.destroy',$vendedore->id) }}" method="POST">
                                                     @can('vendedores.show')
                                                    <a class="btn btn-sm btn-primary " href="{{ route('vendedores.show',$vendedore->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Gestion') }}</a>
                                                    @endcan
                                                     @can('vendedores.edit')
                                                    <a class="btn btn-sm btn-success" href="{{ route('vendedores.edit',$vendedore->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @endcan
                                                    @csrf
                                                    @method('DELETE')
                                                     @can('vendedores.destroy')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
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
                {!! $vendedores->links() !!}
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
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        size:'xl',
        alwaysShowClose: true
      });
    });
  })
</script>
@endpush
