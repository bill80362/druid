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
        Schema::create('goods_photos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('goods_id')->nullable();
            $table->string("name")->nullable()->comment("名稱");
            $table->unsignedInteger("sort")->default(1)->comment("排序");


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_photos');
    }
};
