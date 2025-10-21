@extends('admin.layouts.main')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Crear Nueva Asignación</h1>
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

        <form action="{{ route('asignaciones.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="dispositivo_id">Dispositivo (Disponibles)</label>
                <select name="dispositivo_id" id="dispositivo_id" class="form-control" required>
                    <option value="">-- Seleccione un dispositivo --</option>
                    @foreach($dispositivos as $dispositivo)
                        <option value="{{ $dispositivo->id }}">{{ $dispositivo->nombre_dispositivo }} (N/S: {{ $dispositivo->numero_serie }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_id">Usuario</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">-- Seleccione un usuario --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_asignacion">Fecha de Asignación</label>
                <input type="date" class="form-control" id="fecha_asignacion" name="fecha_asignacion" value="{{ date('Y-m-d') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Asignación</button>
            <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

@endsection