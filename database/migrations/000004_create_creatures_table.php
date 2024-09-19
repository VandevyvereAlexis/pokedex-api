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
        Schema::create('creatures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->default('default.jpg');
            $table->integer('pv');
            $table->integer('atk');
            $table->integer('def');
            $table->integer('speed');
            $table->integer('capture_rate');
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade');
            $table->foreignId('race_id')->constrained('races')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creatures');
    }
};
