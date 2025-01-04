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
        Schema::create('order_ships', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //
            $table->bigInteger("order_id")->unsigned()->nullable()->comment("訂單");
            $table->bigInteger("ship_id")->unsigned()->nullable()->comment("物流");
            //
            $table->char("type",10)->nullable()->comment("類型");
            $table->char("status",10)->nullable()->comment("狀態");
            $table->text("ship_info")->nullable()->comment("配送資訊");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_ships');
    }
};
