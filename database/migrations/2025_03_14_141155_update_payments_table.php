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
        Schema::table('payments', function (Blueprint $table) {
            $table->string("line_pay_channel_id")->nullable()->comment("名稱");
            $table->string("line_pay_channel_secret")->nullable()->comment("名稱");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
