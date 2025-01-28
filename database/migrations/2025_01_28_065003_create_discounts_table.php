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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //基本
            $table->char("status",10)->nullable()->comment("狀態");
            $table->string("name")->nullable()->comment("名稱");
            $table->timestamp("discount_start")->nullable()->comment("折扣時段");
            $table->timestamp("discount_end")->nullable()->comment("折扣時段");

            //類型
            $table->integer("sort")->unsigned()->nullable()->comment("折扣計算順序");
            //觸發條件
            //多選關聯表 level_id
            $table->char("event_type",10)->default("N")->nullable()->comment("觸發折扣條件:M滿額、C滿件、E滿額或滿件、B滿額且滿件、N不限定");
            $table->integer("event_count_threshold")->unsigned()->nullable()->comment("滿額門檻");
            $table->integer("event_money_threshold")->unsigned()->nullable()->comment("滿件門檻");
            //觸發事件，列入計算商品限定
            $table->char("discount_goods_status",10)->default("N")->nullable()->comment("商品:N不限定、I限定、E排除");
            $table->text("discount_goods_sku")->nullable()->comment("商品sku");
            //折扣內容
            $table->char("discount_type",10)->default("M")->nullable()->comment("M折抵、R打折、S固定");
            $table->integer("discount_money")->unsigned()->nullable()->comment("金額折抵額度");
            $table->integer("discount_ratio")->unsigned()->nullable()->comment("金額打折比例");
            $table->integer("discount_static")->unsigned()->nullable()->comment("固定金額");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
