@extends('admin.layouts.main')

@section('contenido')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
</div>

<!-- Content Row: Tarjetas de Estadísticas -->
<div class="row">

    <!-- Tarjeta: Total de Dispositivos -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Dispositivos Totales</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalDispositivos }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-mobile-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta: Dispositivos en Uso -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Dispositivos en Uso</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $dispositivosEnUso }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta: Usuarios Registrados -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Usuarios Registrados
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    {{ $totalUsuarios }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta: Dispositivos en Mantenimiento -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            En Mantenimiento</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $dispositivosEnMantenimiento }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tools fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row: Gráficos -->
<div class="row">

    <!-- Lista de Tipos de Dispositivos -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tipos de Dispositivos</h6>
            </div>
            <div class="card-body">
                @php
                    // Calculamos el total para las barras de progreso.
                    // Usamos el total de dispositivos para que la proporción sea respecto al inventario completo.
                    $totalParaPorcentaje = $totalDispositivos > 0 ? $totalDispositivos : 1;
                @endphp

                @forelse($tiposDispositivos as $tipo => $cantidad)
                    @php
                        $porcentaje = ($cantidad / $totalParaPorcentaje) * 100;
                        $color = $tipo == 'telefono' ? 'bg-warning' : 'bg-info';
                    @endphp
                    <h4 class="small font-weight-bold">{{ ucfirst($tipo) }} <span
                            class="float-right">{{ $cantidad }} Unidades</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar {{ $color }}" role="progressbar" style="width: {{ $porcentaje }}%"
                            aria-valuenow="{{ $porcentaje }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                @empty
                    <p class="text-center text-muted">No hay dispositivos registrados.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Panel: Dispositivos en Mantenimiento -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">Dispositivos en Mantenimiento</h6>
            </div>
            <div class="card-body">
                @forelse($dispositivosEnMantenimientoList as $dispositivo)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <i class="fas fa-mobile-alt text-gray-400 mr-2"></i>
                            <strong>{{ $dispositivo->nombre_dispositivo }}</strong>
                            <span class="text-muted small"> ({{ $dispositivo->marca }} {{ $dispositivo->modelo }})</span>
                        </div>
                        <a href="{{ route('dispositivos.index') }}" class="btn btn-sm btn-outline-secondary">
                            Gestionar
                        </a>
                    </div>
                @empty
                    <p class="text-center text-muted mt-3">No hay dispositivos en mantenimiento actualmente.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection
