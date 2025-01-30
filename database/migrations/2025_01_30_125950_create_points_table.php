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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("name")->comment("名稱");
            $table->bigInteger("member_id")->unsigned()->nullable()->comment("會員");
            $table->bigInteger("order_id")->unsigned()->nullable()->comment("訂單");
            $table->bigInteger("discount_id")->unsigned()->nullable()->comment("優惠");

            $table->integer("point")->comment("點數");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
