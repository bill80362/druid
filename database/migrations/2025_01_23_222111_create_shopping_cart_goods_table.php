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
        Schema::create('shopping_cart_goods', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger("user_id")->unsigned()->nullable()->comment("門市人員");
            $table->bigInteger("goods_detail_id")->unsigned()->nullable()->comment("商品");
            $table->integer("buy_count")->default(1)->nullable()->comment("數量");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart_goods');
    }
};
