@extends('admin.layouts.main')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Historial de Asignaciones</h1>
    <a href="{{ route('asignaciones.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nueva Asignación
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registro de Asignaciones</h6>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dispositivo</th>
                        <th>Usuario Asignado</th>
                        <th>Fecha de Asignación</th>
                        <th>Fecha de Devolución</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asignaciones as $asignacion)
                    <tr>
                        <td>{{ $asignacion->id }}</td>
                        <td>{{ $asignacion->dispositivo->nombre_dispositivo ?? 'N/A' }}</td>
                        <td>{{ $asignacion->user->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($asignacion->fecha_asignacion)->format('d/m/Y') }}</td>
                        <td>
                            {{ $asignacion->fecha_devolucion ? \Carbon\Carbon::parse($asignacion->fecha_devolucion)->format('d/m/Y') : '-' }}
                        </td>
                        <td>
                            @if($asignacion->fecha_devolucion)
                                <span class="badge badge-secondary">Finalizada</span>
                            @else
                                <span class="badge badge-success">Activa</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('asignaciones.pdf', $asignacion) }}" class="btn btn-sm btn-danger" target="_blank"><i class="fas fa-file-pdf"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection