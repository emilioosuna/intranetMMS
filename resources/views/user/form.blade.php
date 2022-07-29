<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
         <div class="form-group">
            <label  for="nivel">Nivel de Acceso</label>
            <select name="nivel" id="nivel" class="form-control select2" >
                <option value="">---</option>
                <option value="1" {{ ($user->nivel == 1) ? "selected" : "" }}>Root</option>
                <option value="2" {{ ($user->nivel == 2) ? "selected" : "" }}>Administrador</option>
                <option value="3" {{ ($user->nivel == 3) ? "selected" : "" }}>Usuario Operaciones</option>
                <option value="4" {{ ($user->nivel == 4) ? "selected" : "" }}>Usuario Generente</option>
               {{--  <option value="5" {{ ($user->nivel == 5) ? "selected" : "" }}>Usuario general</option> --}}
        </select>
        </div>
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
    <hr> <span style="color:grey;"><b>Informacion de la Sucursal</b></span> <hr>
        <div class="form-group">
            {{ Form::label('Tienda') }}
             <select name="tienda" id="tienda" class="form-control select2 {{  $errors->has('tienda') ? ' is-invalid' : '' }}" >
                <option value="">---</option>
                @foreach ($tiendas as $tienda)
                <option value="{{ $tienda->id }}" {{ (($user ? $user->tienda :'') == $tienda->id ) ? "selected" : "" }}>{{ $tienda->tienda }}</option>
                @endforeach
            </select>
            {!! $errors->first('tienda', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    <div class="form-group">
            {{ Form::label('Estado') }}
             <select name="estado_id" id="estado_id" class="form-control select2 {{  $errors->has('estado_id') ? ' is-invalid' : '' }}" >
                <option value="">---</option>
                @foreach ($estados as $estado)
                <option value="{{ $estado->id }}" {{ (($user ? $user->estado_id :'') == $estado->id ) ? "selected" : "" }}>{{ $estado->estado }}</option>
                @endforeach
            </select>
            {!! $errors->first('estado_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Municipio') }}
                 <select name="municipio_id" id="municipio_id" class="form-control select2 {{  $errors->has('municipio_id') ? ' is-invalid' : '' }}" >
                <option value="">---</option>
                @foreach ($municipios as $municipio)
                <option value="{{ $municipio->id }}" {{ (($user ? $user->municipio_id : '')  == $municipio->id ) ? "selected" : "" }}>{{ $municipio->municipio }}</option>
                @endforeach
            </select>
            {!! $errors->first('municipio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Parroquia') }}
                 <select name="parroquia_id" id="parroquia_id" class="form-control select2 {{  $errors->has('parroquia_id') ? ' is-invalid' : '' }}" >
                <option value="">---</option>
                @foreach ($parroquias as $parroquia)
                <option value="{{ $parroquia->id }}" {{ (($user ? $user->parroquia_id : '')  == $parroquia->id ) ? "selected" : "" }}>{{ $parroquia->parroquia }}</option>
                @endforeach
            </select>
            {!! $errors->first('parroquia_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>

