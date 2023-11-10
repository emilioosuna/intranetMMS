<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
                    {{ Form::label('Tienda') }}
                     <select name="tienda_id" id="tienda_id" class="form-control select2 {{  $errors->has('tienda_id') ? ' is-invalid' : '' }}" >
                        <option value="">---</option>
                        @foreach ($tiendas as $tienda)
                        <option value="{{ $tienda->id }}" {{ ((!$facturasVendedore->id ? auth()->user()->tienda : $facturasVendedore->tienda_id) == $tienda->id ) ? "selected" : "" }}>{{ $tienda->tienda }}</option>
                        @endforeach
                    </select>
                    {{-- {{ Form::text('tienda_id', $venta->tienda_id, ['class' => 'form-control' . ($errors->has('tienda_id') ? ' is-invalid' : ''), 'placeholder' => 'Tienda Id']) }} --}}
                    {!! $errors->first('tienda_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fdesde') }}
            {{ Form::date('fdesde', $facturasVendedore->fdesde, ['class' => 'form-control' . ($errors->has('fdesde') ? ' is-invalid' : ''), 'placeholder' => 'Fdesde']) }}
            {!! $errors->first('fdesde', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fdhasta') }}
            {{ Form::date('fdhasta', $facturasVendedore->fdhasta, ['class' => 'form-control' . ($errors->has('fdhasta') ? ' is-invalid' : ''), 'placeholder' => 'Fdhasta']) }}
            {!! $errors->first('fdhasta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
         <div class="form-group">
            {{ Form::file('prueba', ['class' => 'form-control' . ($errors->has('prueba') ? ' is-invalid' : '')]) }}
            {!! $errors->first('prueba', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
</div>
