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
        Schema::create('babysitter_likes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->char('line_user_id',40)->nullable();
            $table->bigInteger('babysitter_id')->nullable();

            $table->index(['line_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('babysitter_likes');
    }
};
