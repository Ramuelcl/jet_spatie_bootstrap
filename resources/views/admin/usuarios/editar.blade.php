@php
$user = isset($datos['usuario']) ? $datos['usuario'] : null;
$roles = isset($datos['roles']) ? $datos['roles'] : null;
$permisos = isset($datos['permisos']) ? $datos['permisos'] : null;
$userRoles = isset($datos['userRole']) ? $datos['userRole'] : null;
$userPerms = isset($datos['userPerm']) ? $datos['userPerm'] : null;
// dd([$user, $roles, $permisos]);
if (!is_null($user)) {
    $new = true;
} else {
    $new = false;
}
// dd([$user, $roles, $permisos, $action]);
@endphp
@extends('layouts.app')

{{-- @section('title', 'Guzanet') --}}

@section('content')
    <div class="card margin:0 auto">
        <div class="card-head">
            @if ($errors->any())
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <strong>Revise los campos</strong>
                    @foreach ($errors as $error)
                        <span class="badge badge-daner">{{ $error }}</span>
                    @endforeach
                    <button type="buton" class="close" data-dismiss="alert" aria-label="close"><span
                            aria-hidden="true">&ttimes;</span></button>
                </div>
            @endif
        </div>
        <div class="card-body">
            {!! Form::model($user, ['route' => ['usuarios.update', $user->id], 'method' => 'PUT']) !!}

            <div class="row mb-3">
                {!! Form::label('name', 'Nombre :', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="row mb-3">
                {!! Form::label('email', 'eMail :', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="row mb-3">
                {!! Form::label('password', 'Password :', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::password('password', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="row mb-3">
                {!! Form::label('password', 'Confirmar Password :', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::password('confirm-password', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Roles</legend>

                <div class="col-sm-10">
                    @foreach ($roles as $rol => $value)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" id="roles[]" value="1"
                                {{ (is_array(old('roles')) and in_array(1, old('roles'))) ? ' checked' : '' }}>
                            <label class="form-check-label" for="roles[]">
                                {{ $rol }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </fieldset>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Permisos</legend>

                <div class="col-sm-10">
                    @foreach ($permisos as $permiso => $value)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permisos[]" id="permisos[]" value="1"
                                {{ (is_array(old('permisos')) and in_array(1, old('permisos'))) ? ' checked' : '' }}>
                            <label class="form-check-label" for="permisos[]">
                                {{ $permiso }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </fieldset>
            <div class="col-xs-12 col-sm-12 col-md-12">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
