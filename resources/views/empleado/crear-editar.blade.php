<div class="card">
    <div class="card-header">
        <h5>{{ $modo }} Empleado</h5>
    </div>
    <div class="card-body">
        @if (count($errors))
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group row">
            <label for="Nombre" class="col-sm-2 col-form-label">Nombre *:</label>
            <div class="col-sm-10">
                <input type="text" name="Nombre"
                    value="{{ isset($empleado->Nombre) ? $empleado->Nombre : old('Nombre') }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="ApellidoPaterno" class="col-sm-2 col-form-label">Apellido Paterno *:</label>
            <div class="col-sm-10">
                <input type="text" name="ApellidoPaterno"
                    value="{{ isset($empleado->ApellidoPaterno) ? $empleado->ApellidoPaterno : old('ApellidoPaterno') }}"
                    class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="ApellidoMaterno" class="col-sm-2 col-form-label">Apellido Materno :</label>
            <div class="col-sm-10">
                <input type="text" name="ApellidoMaterno"
                    value="{{ isset($empleado->ApellidoMaterno) ? $empleado->ApellidoMaterno : old('ApellidoMaterno') }}"
                    class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="Correo" class="col-sm-2 col-form-label">Correo *: </label>
            <div class="col-sm-10">
                <input type="text" name="Correo"
                    value="{{ isset($empleado->Correo) ? $empleado->Correo : old('Correo') }}"
                    class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="Foto" class="col-sm-2 col-form-label">Foto :</label>
            <div class="col-sm-7">
                <input type="file" name="Foto">
            </div>
            <div class="col-sm-3">
                @isset($empleado->Foto)
                    <img src="{{ asset('storage' . '/' . $empleado->Foto) }}" alt="foto" width="100" height="100"
                        class="img-thumbnail img-fluid">
                @endisset
            </div>
        </div>
    </div>

    <div class="btn-group btn-group-md" role="group" row">
        <a href="{{ url('empleado/') }}" class="btn btn-primary col-form">Volver</a>
        <input type="submit" value="{{ $modo }} datos" class="btn btn-success">
    </div>
    <div class="card-footer">* = campos requeridos</div>
</div>
