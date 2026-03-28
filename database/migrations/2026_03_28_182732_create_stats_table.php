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
        Schema::create('stats', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('section', 50);
            $table->string('label', 100);
            $table->string('value', 50);
            $table->string('icon', 100)->nullable();
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
        Schema::dropIfExists('stats');
    }
};
