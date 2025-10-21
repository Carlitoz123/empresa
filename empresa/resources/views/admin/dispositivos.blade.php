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
                        <td><span class="badge badge-info">{{ $dispositivo->estado }}</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection