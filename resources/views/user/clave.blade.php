@extends('adminlte::page')

@section('title', 'Editar Perfil')
@php
 $n = rand(1,3);
@endphp
@section('content_header')
<div class="card card-widget widget-user">
<div class="widget-user-header text-white" style="background: url({{ asset ('img/photo'.$n.'.png') }}) center center;">
<h3 class="widget-user-username text-right" style="color: black;"><b> Cambio Clave </b></h3>
</div>
</div>
@stop
@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                    <div class="card card-info">
                    <div class="card-header">
                           <span id="card_title">
                                {{ __('Cambio Clave Usuario') }}
                            </span>
                        <div class="float-right">
                            <a class="btn bg-dark"  href="{{ route('escritorio') }}">Volver</a>
                        </div>
                    </div>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success msg">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.updateClave', $user->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('put') }}
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="form-group">
                                        {{ Form::label('Password') }}
                                        {{ Form::password('password',['id'=>'password','placeholder'=>'Password','class' => 'form-control'.($errors->has('password') ? ' is-invalid' : ''), 'autocomplete' => 'off']) }}
                                        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}

                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Confirmar password') }}
                                        {{ Form::password('cpassword',['id'=>'cpassword','placeholder'=>'Confirmar password','class' => 'form-control'. ($errors->has('cpassword') ? ' is-invalid' : ''), 'autocomplete' => 'off' ,'onkeyup'=> 'check()']) }}
                                         <span id='message'></span>
                                        {!! $errors->first('cpassword', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>

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
