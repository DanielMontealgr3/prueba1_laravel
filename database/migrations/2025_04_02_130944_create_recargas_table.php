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
        Schema::create('recargas', function (Blueprint $table) {
            $table->id();

          
            $table->unsignedBigInteger('documento_usuario')->nullable();

       
            $table->foreign('documento_usuario') 
                  ->references('documento') 
                  ->on('usuarios')
                  ->nullOnDelete()      
                  ->cascadeOnUpdate();         

          
            $table->decimal('cantidad_recarga', 10, 2);
            $table->decimal('saldo_anterior', 10, 2);
            $table->decimal('saldo_actual', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
     
         Schema::table('recargas', function (Blueprint $table) {
   
             $table->dropForeign(['documento_usuario']);
         });
         Schema::dropIfExists('recargas');
    }
};