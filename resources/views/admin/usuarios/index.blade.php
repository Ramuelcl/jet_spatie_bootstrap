@php
$users = $datos['user'];
@endphp
@extends('layouts.app')

{{-- @section('title', 'Guzanet') --}}

@section('content')
    <div class="card">
        <div class="card-header">
            <input type="text" name="" id="" class="form-control" placeholder="ingrese el nombre o correo de un usuario ">
        </div>
        @if ($users->count())
            <div class="card-body">
                <a href="{{ route('usuarios.create') }}" class="btn btn-warning btn-block">Nuevo</a>
                <table class="table table-striped">
                    <thead style="background-color: #a2acf6;">
                        <tr>
                            <th style="display: none;">Id</th>
                            <th style="color: #fff ;">Nombre</th>
                            <th>eMail</th>
                            <th>Rol(es)</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td style="display: none;">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $rolName)
                                            <h5><span class="badge badge-dark">{{ $rolName }}</span></h5>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-info">Editar</a>
                                    {!! Form::open([
    'method' => 'DELETE',
    'route' => ['usuarios.destroy', $user->id],
    'style' => 'display:inline',
]) !!}
                                    {!! Form::submit('Borrar', [
    'class' => 'btn btn-danger',
]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>>
            </div>
        @endif
    </div>
@endsection
