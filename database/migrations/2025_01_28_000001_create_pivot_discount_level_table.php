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
        Schema::create('pivot_discount_level', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //類型
            $table->integer("discount_id")->unsigned()->nullable()->comment("折扣");
            $table->integer("level_id")->unsigned()->nullable()->comment("等級");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_discount_level');
    }
};
