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
        Schema::table('members', function (Blueprint $table) {
            $table->char("slug",20)->unique()->nullable()->comment("會員卡編號");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
