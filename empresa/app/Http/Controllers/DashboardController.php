<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dispositivo;

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

        // Pasamos los datos a la vista
        return view('admin.dashboard', [
            'totalUsuarios' => $totalUsuarios,
            'totalDispositivos' => $totalDispositivos,
            'dispositivosEnUso' => $dispositivosEnUso,
            'dispositivosEnMantenimiento' => $dispositivosEnMantenimiento,
        ]);
    }
}
