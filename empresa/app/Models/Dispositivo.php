<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dispositivo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dispositivos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'numero_serie',
        'imei',
        'nombre_dispositivo',
        'tipo',
        'marca',
        'modelo',
        'capacidad_almacenamiento_mb',
        'capacidad_ram_mb',
        'estado',
        'fecha_adquisicion',
    ];

    /**
     * Obtiene el historial de asignaciones para el dispositivo.
     */
    public function asignaciones(): HasMany
    {
        return $this->hasMany(Asignacion::class);
    }
}