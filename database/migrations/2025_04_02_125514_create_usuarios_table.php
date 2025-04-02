<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->unsignedBigInteger('documento')->primary();

        
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('correo');
            $table->decimal('saldo_inicial', 10, 2)->default(0); 
            $table->string('ciudad_nacimiento');
            $table->string('contra'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};