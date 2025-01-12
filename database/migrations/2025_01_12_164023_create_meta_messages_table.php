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
        Schema::create('meta_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger("meta_id")->unsigned()->nullable()->comment("Meta帳號");

            $table->char("status",10)->nullable()->comment("類型");
            $table->char("type",10)->nullable()->comment("訊息類型");
            $table->string("message")->nullable()->comment("訊息");
            $table->char("member_meta_id",100)->nullable()->comment("會員");
            $table->timestamp("message_at")->nullable()->comment("訊息時間");

            $table->text("log")->nullable()->comment("原始訊息");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_messages');
    }
};
