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
        Schema::create('projects', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('title', 200);
            $table->string('subtitle', 200)->nullable();
            $table->string('category_id', 50);
            $table->string('year', 20)->nullable();
            $table->text('technologies')->nullable();
            $table->text('description')->nullable();
            $table->string('image', 500)->nullable();
            $table->text('gallery')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('client', 200)->nullable();
            $table->string('url', 500)->nullable();
            $table->string('status', 20)->default('published');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
