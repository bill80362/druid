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
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp("expired_at")->nullable()->comment("到期時間");
            $table->bigInteger("parent_user_id")->unsigned()->nullable()->comment("上層使用者ID");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
