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
        Schema::create('team_members', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('name', 100);
            $table->string('role', 100)->nullable();
            $table->text('bio')->nullable();
            $table->string('image', 500)->nullable();
            $table->string('facebook_url', 500)->nullable();
            $table->string('twitter_url', 500)->nullable();
            $table->string('linkedin_url', 500)->nullable();
            $table->string('instagram_url', 500)->nullable();
            $table->integer('display_order')->default(0);
            $table->string('status', 20)->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
