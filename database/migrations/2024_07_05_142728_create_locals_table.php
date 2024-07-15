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
        Schema::create('locals', function (Blueprint $table) {
            $table->id(); // Cria uma coluna 'id' como chave primária auto-incrementável.
            $table->string('name', 45); // Cria uma coluna 'name' do tipo string com um limite de 45 caracteres.
            $table->longText('description')->nullable(); // Cria uma coluna 'description' que pode armazenar texto longo e é opcional (nullable).
            $table->string('coordinates', 45); // Cria uma coluna 'coordinates' do tipo string com um limite de 45 caracteres.
            $table->enum('type', ['beach', 'fluvial', 'cascade']); // Cria uma coluna 'type' do tipo enum com valores permitidos: 'beach', 'fluvial', 'cascade'.
            $table->timestamps();  // Cria colunas 'created_at' e 'updated_at' para rastrear datas de criação e atualização.
            $table->foreignId('districts_id')->constrained('districts', 'id')->cascadeOnDelete()->cascadeOnUpdate();  // Cria uma coluna 'districts_id' como chave estrangeira que referencia 'id' na tabela 'districts', com ações de exclusão e atualização em cascata.
            $table->foreignId('regions_id')->constrained('regions', 'id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locals');
    }
};
