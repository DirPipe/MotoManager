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
       
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mecanico_id')->constrained('users');
            $table->foreignId('moto_id')->constrained('motos');
            $table->text('descripcion');
            $table->timestamp('fecha_inicio');
            $table->timestamp('fecha_fin')->nullable();
            $table->integer('tiempo_estimado');
            $table->string('partes_necesarias')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
