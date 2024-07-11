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
        Schema::create('locals_has_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attributes_id')->constrained('attributes', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('locals_id')->constrained('locals', 'id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locals_has_attributes');
    }
};
