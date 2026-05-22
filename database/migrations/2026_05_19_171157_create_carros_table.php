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
        Schema::create('carros', function (Blueprint $table) {
           $table->id();

            $table->string('matricula')->nullable();
            $table->string('cor')->nullable();
            $table->string('nome_motorista')->nullable();
            $table->string('nr_motorista')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();

            $table->foreignId('id_viagem')
                ->constrained('viagems')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carros');
    }
};
