<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Opcional: Limpiar la tabla antes de sembrar para evitar duplicados
        // User::truncate(); // O DB::table('users')->truncate(); si no usas el modelo

        $users = [];
        $now = now();

        // Usuario Administrador
        $users[] = [
            'name' => 'Carlos Galvez',
            'email' => 'carlos@gmail.com',
            'password' => Hash::make('123'),
            'nickname' => 'admin',
            'img' => 'default.jpg',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // Usuario Adair Peralta
        $users[] = [
            'name' => 'Adair Peralta',
            'email' => 'adair@gmail.com',
            'password' => Hash::make('123'),
            'nickname' => 'adair',
            'img' => 'default.jpg',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        /* // Generar 50 usuarios de prueba
        for ($i = 1; $i <= 50; $i++) {
            $users[] = [
                'name' => 'Carlos Galvez ' . $i,
                'email' => 'carlitos' . $i . '@gmail.com',
                'password' => Hash::make('123'),
                'nickname' => 'carlitos' . $i,
                'img' => 'default.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        } */

        // Insertar todos los usuarios en una sola consulta
        DB::table('users')->insert($users);
    }
}
