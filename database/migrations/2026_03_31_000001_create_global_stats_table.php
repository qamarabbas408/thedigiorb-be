<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('global_stats', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('key', 100)->unique();
            $table->string('label', 100);
            $table->string('value', 50);
            $table->string('icon', 100)->nullable();
            $table->integer('display_order')->default(0);
            $table->string('status', 20)->default('published');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('global_stats');
    }
};
