<?php

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
        Schema::create('profesor', function (Blueprint $table) {
           $table->id();

        // Nombre del profesor
        $table->string('nombre', 100);

        // Apellidos del profesor
        $table->string('apellidos', 130);

        // Especialidad del profesor
        $table->string('especialidad', 100);

        // Fecha de incorporación
        $table->date('fecha_alta');

        // Salario con dos decimales
        $table->decimal('salario', 8, 2);

        // Evita repetir la combinación de nombre y apellidos
        $table->unique(['nombre', 'apellidos']);

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesor');
    }
};
