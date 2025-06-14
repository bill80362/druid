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
        Schema::table('cities', function (Blueprint $table) {
            $table->integer('sort')->default(1)->nullable()->comment('排序');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
