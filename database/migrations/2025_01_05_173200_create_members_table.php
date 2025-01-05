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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->char("status",10)->nullable()->comment("狀態");

            $table->string("account")->nullable()->comment("帳號");
            $table->string("password")->nullable()->comment("密碼");

            $table->string("line_id")->nullable()->comment("LineID");

            $table->string("name")->nullable()->comment("名字");
            $table->string("phone")->nullable()->comment("電話");
            $table->string("postal_code")->nullable()->comment("郵遞區號");
            $table->string("address")->nullable()->comment("地址");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
