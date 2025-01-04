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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //
            $table->bigInteger("order_id")->unsigned()->nullable()->comment("訂單");
            //
            $table->char("type",10)->nullable()->comment("類型");
            $table->char("status",10)->nullable()->comment("狀態");
            $table->string("name")->nullable()->comment("名稱");
            $table->string("goods_sku")->nullable()->comment("SKU");
            $table->bigInteger("goods_detail_id")->unsigned()->nullable()->comment("商品");
            $table->string("goods_spec_id")->nullable()->comment("物流手續費");
            $table->float("price_origin")->nullable()->comment("商品價格");
            $table->float("price")->nullable()->comment("折扣後價格");
            $table->text("discount_log")->nullable()->comment("折價記錄");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
