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
        Schema::create('postos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable(false); 
            $table->string('cep')->nullable(); 
            $table->string('estado')->nullable(); 
            $table->string('rua')->nullable();
            $table->integer('numero')->nullable(); 
            $table->decimal('latitude', 9, 6)->nullable(); 
            $table->decimal('longitude', 9, 6)->nullable(); 
            $table->string('horarioFuncionamento')->nullable(false); 
            $table->string('diaFuncionamento')->nullable(false); 
            $table->text('servicos')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postos');
    }
};
