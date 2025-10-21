<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AsignacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nota: La tabla 'asignaciones' ya se limpia en DispositivosSeeder.
        // Si ejecutas este seeder de forma independiente, deberías descomentar
        // las líneas para deshabilitar/habilitar las claves foráneas y truncar la tabla.

        // Obtenemos los IDs de los usuarios y dispositivos existentes para crear asignaciones realistas.
        $userIds = DB::table('users')->pluck('id');
        $dispositivoIds = DB::table('dispositivos')->pluck('id');

        // Verificamos que existan usuarios y dispositivos para evitar errores.
        if ($userIds->isEmpty() || $dispositivoIds->isEmpty()) {
            return;
        }

        $asignaciones = [
            // --- Historial del Dispositivo 1 (Tablet Samsung) ---
            // Asignación histórica: Perteneció a Adair Peralta.
            [
                'dispositivo_id' => $dispositivoIds[0], // Tablet Samsung
                'user_id' => $userIds[1],          // Adair Peralta
                'fecha_asignacion' => Carbon::parse('2023-02-20'),
                'fecha_devolucion' => Carbon::parse('2024-05-09'), // Ya fue devuelto
                'observaciones' => 'Devuelto con desgaste normal por uso.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Asignación activa: Ahora lo tiene Carlos Galvez.
            [
                'dispositivo_id' => $dispositivoIds[0], // Tablet Samsung
                'user_id' => $userIds[0],          // Carlos Galvez
                'fecha_asignacion' => Carbon::parse('2024-05-10'),
                'fecha_devolucion' => null, // Aún no ha sido devuelto (asignación activa)
                'observaciones' => 'Entregado en buen estado para proyecto de encuestas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insertar los registros en la base de datos.
        DB::table('asignaciones')->insert($asignaciones);
    }
}