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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf')->unique(); 
            $table->string('email')->unique(); 
            $table->string('rua');
            $table->string('numero');
            $table->string('estado');
            $table->string('celular');
            $table->string('senha'); 
            $table->string('cep')->nullable(); 
            $table->decimal('latitude', 9, 6)->nullable(); 
            $table->decimal('longitude', 9, 6)->nullable(); 
            $table->unsignedBigInteger('id_postos')->nullable(); 
            $table->timestamps();

            $table->foreign('id_postos')->references('id')->on('postos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
