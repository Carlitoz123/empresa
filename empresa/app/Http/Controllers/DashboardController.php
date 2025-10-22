<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dispositivo;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index(){
        // Realizamos las consultas para obtener los datos
        $totalUsuarios = User::count();
        $totalDispositivos = Dispositivo::count();
        $dispositivosEnUso = Dispositivo::where('estado', 'en_uso')->count();
        $dispositivosEnMantenimiento = Dispositivo::where('estado', 'mantenimiento')->count();

        // --- Datos para el Gráfico Circular (Tipos de Dispositivos) ---
        $tiposDispositivos = Dispositivo::select('tipo', DB::raw('count(*) as total'))
                                        ->groupBy('tipo')
                                        ->pluck('total', 'tipo');

        // Obtenemos la lista de dispositivos que están en mantenimiento
        $dispositivosEnMantenimientoList = Dispositivo::where('estado', 'mantenimiento')->get();

        // Pasamos los datos a la vista
        return view('admin.dashboard', [
            'totalUsuarios' => $totalUsuarios,
            'totalDispositivos' => $totalDispositivos,
            'dispositivosEnUso' => $dispositivosEnUso,
            'dispositivosEnMantenimiento' => $dispositivosEnMantenimiento,
            'tiposDispositivos' => $tiposDispositivos,
            'dispositivosEnMantenimientoList' => $dispositivosEnMantenimientoList,
        ]);
    }
}
