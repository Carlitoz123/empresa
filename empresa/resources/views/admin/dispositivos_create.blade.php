@extends('admin.layouts.main')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Añadir Nuevo Dispositivo</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('dispositivos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_dispositivo">Nombre del Dispositivo</label>
                <input type="text" class="form-control" id="nombre_dispositivo" name="nombre_dispositivo" value="{{ old('nombre_dispositivo') }}" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="numero_serie">Número de Serie</label>
                    <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="{{ old('numero_serie') }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="imei">IMEI (Opcional)</label>
                    <input type="text" class="form-control" id="imei" name="imei" value="{{ old('imei') }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="tipo">Tipo</label>
                    <select id="tipo" name="tipo" class="form-control" required>
                        <option value="telefono" {{ old('tipo') == 'telefono' ? 'selected' : '' }}>Teléfono</option>
                        <option value="tablet" {{ old('tipo') == 'tablet' ? 'selected' : '' }}>Tablet</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="marca">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="modelo">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo') }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Dispositivo</button>
            <a href="{{ route('dispositivos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

@endsection