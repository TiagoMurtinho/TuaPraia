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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('locals_id')->constrained('locals','id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('users_id')->constrained('users','id')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('rating', [1, 2, 3, 4, 5])->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
