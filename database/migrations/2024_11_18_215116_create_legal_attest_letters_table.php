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
        Schema::create('legal_attest_letters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("user_id")->comment("擁有者");
            //
            $table->string("addressee1")->nullable()->comment("收件人");
            $table->string("postal_code1")->nullable()->comment("收件人郵遞區號");
            $table->string("postal_address1")->nullable()->comment("收件人地址");

            $table->string("addressee2")->nullable()->comment("副本收件人");
            $table->string("postal_code2")->nullable()->comment("副本收件人郵遞區號");
            $table->string("postal_address2")->nullable()->comment("副本收件人地址");

            $table->string("sender")->nullable()->comment("寄件人");
            $table->string("sender_postal_code")->nullable()->comment("寄件人郵遞區號");
            $table->string("sender_postal_address")->nullable()->comment("寄件人地址");

            $table->text("content")->nullable()->comment("內文");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_attest_letters');
    }
};
