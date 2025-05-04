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
        Schema::create('pivot_babysitter_service', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('babysitter_id');
            $table->unsignedBigInteger('babysitter_service_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_babysitter_service');
    }
};
