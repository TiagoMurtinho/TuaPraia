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
            $table->id();
            $table->string('name', 45);
            $table->longText('description')->nullable();
            $table->string('coordinates', 45);
            $table->enum('type', ['beach', 'fluvial', 'cascade']);
            $table->timestamps();
            $table->foreignId('districts_id')->constrained('districts', 'id')->cascadeOnDelete()->cascadeOnUpdate();
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
