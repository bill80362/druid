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
        Schema::create('goods_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('goods_id')->nullable();
//            $table->bigInteger('spec_option_id')->nullable();

            $table->string("name")->nullable()->comment("名稱");
            $table->string("sku")->nullable()->comment("");
            $table->unsignedInteger("price")->nullable()->comment("價格");
            $table->char("status",1)->default("Y")->comment("狀態");
            $table->unsignedInteger("sort")->default(1)->comment("排序");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_details');
    }
};
