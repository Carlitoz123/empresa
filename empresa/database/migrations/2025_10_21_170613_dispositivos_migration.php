<?php

// database/migrations/..._create_dispositivos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id();

            //  Campos de Identificación del Dispositivo
            $table->string('numero_serie')->unique();
            $table->string('imei')->unique()->nullable();
            $table->string('nombre_dispositivo');
            
            // ℹ Campos de Especificación
            $table->enum('tipo', ['tablet', 'telefono']);
            $table->string('marca');
            $table->string('modelo');
            $table->unsignedInteger('capacidad_almacenamiento_mb')->nullable()->comment('Capacidad en Megabytes');
            $table->unsignedInteger('capacidad_ram_mb')->nullable()->comment('Capacidad en Megabytes');

            //  Campos de Estado y Asignación
            $table->enum('estado', ['activo', 'en_uso', 'mantenimiento', 'baja'])->default('activo');
            $table->timestamp('fecha_adquisicion')->nullable();
            
            //  Relación con Usuarios (Asignación)
            // Relación opcional a la tabla 'users'. Indica a quién está asignado actualmente.
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); 

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositivos');
    }
};