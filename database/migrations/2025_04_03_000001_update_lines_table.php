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
        Schema::table('lines', function (Blueprint $table) {
            $table->bigInteger("user_id")->unsigned()->nullable()->comment("所有者");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
