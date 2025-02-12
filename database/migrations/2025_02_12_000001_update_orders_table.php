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
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->float("coupon_discount")->nullable()->comment("優惠卷折扣金額");
            $table->bigInteger("coupon_id")->unsigned()->nullable()->comment("優惠卷");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
