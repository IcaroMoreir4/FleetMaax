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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('origem');
            $table->string('destino');
            $table->dateTime('data_saida');
            $table->dateTime('data_chegada');
            $table->string('status')->default('pendente');
            $table->foreignId('motorista_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('caminhao_id')->nullable()->constrained('caminhoes')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
