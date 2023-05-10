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
        Schema::create('image_polymorphics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->constrained()->cascadeOnDelete();
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_polymorphics');
    }
};
