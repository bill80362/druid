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
        Schema::table('goods', function (Blueprint $table) {
            $table->text("content1")->nullable()->comment("商品描述");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
