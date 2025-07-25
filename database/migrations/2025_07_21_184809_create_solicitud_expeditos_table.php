<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('solicitud_expeditos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_tramite'); // Agregamos el título del trámite
            $table->string('sustento');
            $table->json('archivos'); // Guardaremos nombres o paths como JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_expeditos');
    }
};