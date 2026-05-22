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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('apelido');
            $table->date('data_nascimento');
            $table->enum('genero', ['Masculino', 'Feminino']);
            $table->string('turma');
            $table->string('bairro');
            $table->string('nr_celular01');
            $table->string('nr_celular02');
            $table->timestamps();

            $table->foreignId('id_carro')
                ->constrained('carros')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
