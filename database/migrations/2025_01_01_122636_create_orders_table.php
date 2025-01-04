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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //狀態
            $table->char("status",10)->nullable()->comment("狀態");
            //
            $table->bigInteger("member_id")->unsigned()->nullable()->comment("會員");
            //訂單資訊
            $table->float("detail_subtotal")->nullable()->comment("明細小計");
            $table->float("payment_fee")->nullable()->comment("金流手續費");
            $table->float("shipping_fee")->nullable()->comment("物流手續費");
            $table->float("total")->nullable()->comment("訂單金額");
            //購買人
            $table->string("buyer_name")->nullable()->comment("購買人");
            $table->string("buyer_phone")->nullable()->comment("購買人電話");
            //收件人
            $table->string("receiver_name")->nullable()->comment("收件人");
            $table->string("receiver_phone")->nullable()->comment("收件人手機");
            $table->string("receiver_postal_code")->nullable()->comment("收件人郵遞區號");
            $table->string("receiver_address")->nullable()->comment("收件人地址");
            $table->string("receiver_memo")->nullable()->comment("收件人備註");
            //備註
            $table->text("memo")->nullable()->comment("訂單備註");
            $table->text("memo_admin")->nullable()->comment("管理者備註");
            //行銷
            $table->char("promotion_code",50)->nullable()->comment("行銷代碼");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
