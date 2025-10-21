<?php

namespace App\Http\Controllers;

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
}