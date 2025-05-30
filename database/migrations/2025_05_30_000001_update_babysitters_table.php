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
        Schema::table('babysitters', function (Blueprint $table) {
            $table->bigInteger("sign_at")->unsigned()->nullable()->comment("簽到時間");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
