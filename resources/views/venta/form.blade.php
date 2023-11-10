<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    {{ Form::label('Tienda') }}
                     <select name="tienda_id" id="tienda_id" class="form-control select2 {{  $errors->has('tienda_id') ? ' is-invalid' : '' }}" >
                        <option value="">---</option>
                        @foreach ($tiendas as $tienda)
                        <option value="{{ $tienda->id }}" {{ ((!$venta->id ? auth()->user()->tienda : $venta->tienda_id) == $tienda->id ) ? "selected" : "" }}>{{ $tienda->tienda }}</option>
                        @endforeach
                    </select>
                    {{-- {{ Form::text('tienda_id', $venta->tienda_id, ['class' => 'form-control' . ($errors->has('tienda_id') ? ' is-invalid' : ''), 'placeholder' => 'Tienda Id']) }} --}}
                    {!! $errors->first('tienda_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    {{ Form::label('fventa') }}
                    {{ Form::date('fventa', $venta->fventa, ['class' => 'form-control' . ($errors->has('fventa') ? ' is-invalid' : ''), 'placeholder' => 'Fventa']) }}
                    {!! $errors->first('fventa', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    {{ Form::label('fregistro') }}
                    {{ Form::text('fregistro', date('Y-m-d'), ['id'=>'fregistro','class' => 'form-control' . ($errors->has('fregistro') ? ' is-invalid' : ''), 'placeholder' => 'Fregistro','readonly']) }}
                    {!! $errors->first('fregistro', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    {{ Form::label('contado') }}
                    {{ Form::text('contado', (!$venta->contado ? '0.0000' : $venta->contado), ['class' => 'form-control text-right' . ($errors->has('contado') ? ' is-invalid' : ''), 'placeholder' => 'Contado','onkeypress'=>'return justNumbers(event)','style'=>'text-align']) }}
                    {!! $errors->first('contado', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    {{ Form::label('credito') }}
                    {{ Form::text('credito', (!$venta->credito ? '0.0000' : $venta->credito) , ['class' => 'form-control text-right' . ($errors->has('credito') ? ' is-invalid' : ''), 'placeholder' => 'Credito','onkeypress'=>'return justNumbers(event)']) }}
                    {!! $errors->first('credito', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('linea_blanca') }}
                    {{ Form::text('linea_blanca', (!$venta->linea_blanca ? '0' : $venta->linea_blanca), ['class' => 'form-control text-right' . ($errors->has('linea_blanca') ? ' is-invalid' : ''), 'placeholder' => 'Linea Blanca','onkeypress'=>'return justNumbers(event)']) }}
                    {!! $errors->first('linea_blanca', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('linea_menor') }}
                    {{ Form::text('linea_menor', (!$venta->linea_menor ? '0' : $venta->linea_menor), ['class' => 'form-control text-right' . ($errors->has('linea_menor') ? ' is-invalid' : ''), 'placeholder' => 'Linea Menor','onkeypress'=>'return justNumbers(event)']) }}
                    {!! $errors->first('linea_menor', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('linea_marron') }}
                    {{ Form::text('linea_marron', (!$venta->linea_marron? '0' : $venta->linea_marron) , ['class' => 'form-control text-right' . ($errors->has('linea_marron') ? ' is-invalid' : ''), 'placeholder' => 'Linea Marron','onkeypress'=>'return justNumbers(event)']) }}
                    {!! $errors->first('linea_marron', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('aire_acondicionados') }}
                    {{ Form::text('aire_acondicionados', (!$venta->aire_acondicionados ? '0' : $venta->aire_acondicionados), ['class' => 'form-control text-right' . ($errors->has('aire_acondicionados') ? ' is-invalid' : ''), 'placeholder' => 'Aire Acondicionados','onkeypress'=>'return justNumbers(event)']) }}
                    {!! $errors->first('aire_acondicionados', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('celulares') }}
                    {{ Form::text('celulares', (!$venta->celulares ? '0' : $venta->celulares), ['class' => 'form-control text-right' . ($errors->has('celulares') ? ' is-invalid' : ''), 'placeholder' => 'Celulares','onkeypress'=>'return justNumbers(event)']) }}
                    {!! $errors->first('celulares', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('otros') }}
                    {{ Form::text('otros', (!$venta->otros ? '0' : $venta->otros), ['class' => 'form-control text-right' . ($errors->has('otros') ? ' is-invalid' : ''), 'placeholder' => 'Otros','onkeypress'=>'return justNumbers(event)']) }}
                    {!! $errors->first('otros', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>
