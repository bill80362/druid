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
        Schema::create('goods_detail_spec_option', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('goods_detail_id')->nullable();
            $table->bigInteger('spec_id')->nullable();
            $table->bigInteger('spec_option_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_detail_spec_option');
    }
};
