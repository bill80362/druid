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
        Schema::create('babysitters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //
            $table->uuid('slug')->nullable();
            $table->char('status',1)->nullable()->comment("狀態:保母自行登錄、衛生福利部托育媒合平台");
            //聯絡
            $table->string('name')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('line_id')->nullable();
            //地址
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('address')->nullable();
            //
            $table->char('apply_money',1)->nullable()->comment('可申請補助');
            $table->text('info')->nullable()->comment('托育資訊');
            //詳細說明連結
            $table->string('url')->nullable()->comment('詳細說明網址');
            $table->string('certification')->nullable()->comment('認證編號');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('babysitters');
    }
};
