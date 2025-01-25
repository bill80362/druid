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
        Schema::create('shopping_payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger("user_id")->unsigned()->nullable()->comment("門市人員");
            $table->bigInteger("payment_id")->unsigned()->nullable()->comment("付款方式");
            $table->integer("money")->nullable()->comment("金額");
            $table->string("memo")->nullable()->comment("備註");


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_payments');
    }
};
