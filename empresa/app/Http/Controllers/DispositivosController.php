<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Dispositivo;
use Illuminate\Http\Request;

class DispositivosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dispositivos = Dispositivo::all();
        return view('admin.dispositivos', compact('dispositivos'));
    }

    public function create()
    {
        return view('admin.dispositivos_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_serie' => 'required|unique:dispositivos,numero_serie',
            'nombre_dispositivo' => 'required|string|max:255',
            'tipo' => 'required|in:tablet,telefono',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
        ]);

        Dispositivo::create($request->all());

        return redirect()->route('dispositivos.index')->with('success', 'Dispositivo creado correctamente.');
    }

    /**
     * Pone un dispositivo en estado de mantenimiento.
     */
    public function setMantenimiento(Dispositivo $dispositivo)
    {
        // Solo se puede poner en mantenimiento si está 'activo'
        if ($dispositivo->estado === 'activo') {
            $dispositivo->estado = 'mantenimiento';
            $dispositivo->save();
            return redirect()->route('dispositivos.index')->with('success', 'El dispositivo se ha puesto en mantenimiento.');
        }
        return redirect()->route('dispositivos.index')->with('error', 'Acción no permitida. El dispositivo no está activo.');
    }

    /**
     * Cambia el estado de un dispositivo de 'mantenimiento' a 'activo'.
     */
    public function setActivo(Dispositivo $dispositivo)
    {
        // Solo se puede activar si está en 'mantenimiento'
        if ($dispositivo->estado === 'mantenimiento') {
            $dispositivo->estado = 'activo';
            $dispositivo->save();
            return redirect()->route('dispositivos.index')->with('success', 'El dispositivo ha sido activado.');
        }
        return redirect()->route('dispositivos.index')->with('error', 'Acción no permitida. El dispositivo no está en mantenimiento.');
    }

    /**
     * Elimina un dispositivo de la base de datos.
     */
    public function destroy(Dispositivo $dispositivo)
    {
        // No permitir borrar si el dispositivo está actualmente asignado ('en_uso')
        if ($dispositivo->estado === 'en_uso') {
            return redirect()->route('dispositivos.index')->with('error', 'No se puede eliminar un dispositivo que está actualmente asignado.');
        }
        // También verificamos si tiene asignaciones históricas para evitar borrar datos relacionados.
        if (Asignacion::where('dispositivo_id', $dispositivo->id)->exists()) {
             return redirect()->route('dispositivos.index')->with('error', 'No se puede eliminar un dispositivo con historial de asignaciones. Primero elimine las asignaciones asociadas.');
        }
        $dispositivo->delete();
        return redirect()->route('dispositivos.index')->with('success', 'Dispositivo eliminado correctamente.');
    }
}