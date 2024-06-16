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
        Schema::create('propiedades', function (Blueprint $table) {
            Schema::dropIfExists('propiedades');
            $table->id();
            $table->string('calles');
            $table->integer('cant_habitaciones')->nullable();
            $table->integer('cant_banios')->nullable();
            $table->string('cant_personas')->nullable();
            $table->integer('tamanio')->nullable();
            $table->integer('estado');
            $table->decimal('latitud', 15, 10)->nullable();
            $table->decimal('longitud', 15, 10)->nullable();
            $table->integer('tipo_alquiler')->nullable();
            $table->boolean('venta')->default(false);
            $table->integer('precio')->nullable();
            $table->unsignedBigInteger('barrio_id');
            $table->string('nombre_imagen')->nullable();
            $table->foreign('barrio_id')->references('id')->on('barrios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedades');
    }
};
