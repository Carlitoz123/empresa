<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Importamos Carbon para manejar las fechas fácilmente

class DispositivosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Opcional: Limpiar la tabla antes de sembrar
        DB::table('dispositivos')->truncate();

        // 📝 Definición de los datos de prueba
        $dispositivos = [
            [
                'numero_serie' => 'TAB-A001-XYZ',
                'imei' => null, // Las tablets no tienen IMEI
                'nombre_dispositivo' => 'Tablet Encuesta 01',
                'tipo' => 'tablet',
                'marca' => 'Samsung',
                'modelo' => 'Galaxy Tab A8',
                'capacidad_almacenamiento_mb' => 64 * 1024, // 64GB
                'capacidad_ram_mb' => 4 * 1024, // 4GB
                'estado' => 'en_uso',
                'fecha_adquisicion' => Carbon::parse('2023-01-15'),
                'user_id' => 1, // Asignado al User ID 1 (si existe)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numero_serie' => 'TEL-B002-QWE',
                'imei' => '359876000000001',
                'nombre_dispositivo' => 'Teléfono Supervisor',
                'tipo' => 'telefono',
                'marca' => 'Xiaomi',
                'modelo' => 'Redmi Note 11',
                'capacidad_almacenamiento_mb' => 128 * 1024, // 128GB
                'capacidad_ram_mb' => 6 * 1024, // 6GB
                'estado' => 'activo',
                'fecha_adquisicion' => Carbon::parse('2024-03-10'),
                'user_id' => null, // Disponible para asignar
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numero_serie' => 'TAB-C003-RTY',
                'imei' => null,
                'nombre_dispositivo' => 'Tablet Backup 03',
                'tipo' => 'tablet',
                'marca' => 'Apple',
                'modelo' => 'iPad 9th Gen',
                'capacidad_almacenamiento_mb' => 256 * 1024, // 256GB
                'capacidad_ram_mb' => 4 * 1024, // 4GB
                'estado' => 'mantenimiento',
                'fecha_adquisicion' => Carbon::parse('2022-07-20'),
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // 🚀 Insertar todos los registros de una sola vez
        DB::table('dispositivos')->insert($dispositivos);
    }
}