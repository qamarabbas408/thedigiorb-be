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
        Schema::create('services', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->string('icon', 100)->default('bi-lightbulb');
            $table->boolean('featured')->default(false);
            $table->integer('display_order')->default(0);
            $table->string('status', 20)->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
