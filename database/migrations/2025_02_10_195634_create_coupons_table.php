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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //基本
            $table->char("signed",10)->nullable()->comment("具名");
            $table->char("status",10)->nullable()->comment("狀態");
            $table->string("name")->nullable()->comment("名稱");
            $table->string("coupon_code")->nullable()->comment("折扣碼");
            $table->timestamp("discount_start")->nullable()->comment("折扣時段");
            $table->timestamp("discount_end")->nullable()->comment("折扣時段");
            //折扣內容
            $table->char("coupon_type",10)->default("M")->nullable()->comment("M結帳金額折抵、R結帳金額打折");
            $table->integer("discount_money")->unsigned()->nullable()->comment("金額折抵額度");
            $table->integer("discount_ratio")->unsigned()->nullable()->comment("金額打折比例");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
