<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asignacion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'asignaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dispositivo_id',
        'user_id',
        'fecha_asignacion',
        'fecha_devolucion',
        'observaciones',
    ];

    /**
     * Obtiene el dispositivo asociado a la asignación.
     */
    public function dispositivo(): BelongsTo
    {
        return $this->belongsTo(Dispositivo::class);
    }

    /**
     * Obtiene el usuario asociado a la asignación.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}