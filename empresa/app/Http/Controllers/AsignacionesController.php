<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Dispositivo;
use App\Models\User;
use Illuminate\Http\Request;
use PDF; // Cambia esta línea
use Carbon\Carbon;

class AsignacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Usamos 'with' para cargar las relaciones y evitar consultas N+1
        $asignaciones = Asignacion::with(['dispositivo', 'user'])->orderBy('fecha_asignacion', 'desc')->get();
        return view('admin.asignaciones', compact('asignaciones'));
    }

    public function create()
    {
        // Obtenemos solo dispositivos 'activos' (disponibles) y todos los usuarios
        $dispositivos = Dispositivo::where('estado', 'activo')->get();
        $users = User::all();
        return view('admin.asignaciones_create', compact('dispositivos', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dispositivo_id' => 'required|exists:dispositivos,id',
            'user_id' => 'required|exists:users,id',
            'fecha_asignacion' => 'required|date',
        ]);

        // Creamos la asignación
        Asignacion::create($request->all());

        // Actualizamos el estado del dispositivo a 'en_uso'
        $dispositivo = Dispositivo::find($request->dispositivo_id);
        $dispositivo->estado = 'en_uso';
        $dispositivo->save();

        return redirect()->route('asignaciones.index')->with('success', 'Asignación creada correctamente.');
    }

    public function generarPdf(Asignacion $asignacion)
    {
        // Carga las relaciones para tener los datos en la vista del PDF
        $asignacion->load(['user', 'dispositivo']);
        $pdf = PDF::loadView('admin.pdf.responsiva', compact('asignacion')); // Y también aquí
        return $pdf->stream('responsiva-'.$asignacion->id.'.pdf');
    }

    public function devolver(Asignacion $asignacion)
    {
        // 1. Validar que la asignación no esté ya finalizada
        if ($asignacion->fecha_devolucion) {
            return redirect()->route('asignaciones.index')->with('error', 'Esta asignación ya ha sido finalizada.');
        }

        // 2. Actualizar la fecha de devolución en la asignación
        $asignacion->fecha_devolucion = Carbon::now();
        $asignacion->save();

        // 3. Actualizar el estado del dispositivo a 'activo' (disponible)
        $dispositivo = $asignacion->dispositivo;
        $dispositivo->estado = 'activo';
        $dispositivo->save();

        // 4. Redirigir con un mensaje de éxito
        return redirect()->route('asignaciones.index')->with('success', 'Dispositivo devuelto y asignación finalizada correctamente.');
    }
}