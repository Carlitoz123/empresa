@extends('admin.layouts.main')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Gestión de Dispositivos</h1>
    <a href="{{ route('dispositivos.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nuevo Dispositivo
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Dispositivos</h6>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>N/S</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dispositivos as $dispositivo)
                    <tr>
                        <td>{{ $dispositivo->id }}</td>
                        <td>{{ $dispositivo->nombre_dispositivo }}</td>
                        <td>{{ ucfirst($dispositivo->tipo) }}</td>
                        <td>{{ $dispositivo->marca }}</td>
                        <td>{{ $dispositivo->modelo }}</td>
                        <td>{{ $dispositivo->numero_serie }}</td>
                        <td>
                            @if($dispositivo->estado == 'activo')
                                <span class="badge badge-success">Activo</span>
                            @elseif($dispositivo->estado == 'en_uso')
                                <span class="badge badge-info">En Uso</span>
                            @elseif($dispositivo->estado == 'mantenimiento')
                                <span class="badge badge-warning">Mantenimiento</span>
                            @else
                                <span class="badge badge-secondary">{{ ucfirst($dispositivo->estado) }}</span>
                            @endif
                        </td>
                        <td>
                            <!-- Botón para poner en mantenimiento (si está activo) -->
                            @if($dispositivo->estado == 'activo')
                                <form action="{{ route('dispositivos.mantenimiento', $dispositivo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Poner este equipo en mantenimiento?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning" title="Poner en Mantenimiento"><i class="fas fa-tools"></i></button>
                                </form>
                            @endif

                            <!-- Botón para activar (si está en mantenimiento) -->
                            @if($dispositivo->estado == 'mantenimiento')
                                <form action="{{ route('dispositivos.activar', $dispositivo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Activar este equipo?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" title="Activar Dispositivo"><i class="fas fa-power-off"></i></button>
                                </form>
                            @endif

                            <!-- Botón para eliminar (si no está en uso) -->
                            @if($dispositivo->estado != 'en_uso')
                                <form action="{{ route('dispositivos.destroy', $dispositivo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este dispositivo? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar Dispositivo"><i class="fas fa-trash"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection