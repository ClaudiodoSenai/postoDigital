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
            $table->string('nome')->nullable(false); // Garantindo que o campo 'nome' seja obrigatório
            $table->string('localizacao')->nullable(false); // Garantindo que o campo 'localizacao' seja obrigatório
            $table->decimal('latitude', 9, 6)->nullable(); // Removendo a cláusula 'after'
            $table->decimal('longitude', 9, 6)->nullable(); // Removendo a cláusula 'after'
            $table->string('horarioFuncionamento')->nullable(false); // Garantindo que o campo 'horarioFuncionamento' seja obrigatório
            $table->string('diaFuncionamento')->nullable(false); // Garantindo que o campo 'diaFuncionamento' seja obrigatório
            $table->text('servicos')->nullable(false); // Garantindo que o campo 'servicos' seja obrigatório
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
