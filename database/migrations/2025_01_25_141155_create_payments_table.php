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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer("sort")->default(1)->comment("排序");
            $table->char("status",1)->default("Y")->nullable()->comment("狀態");
            $table->char("type",1)->default("N")->nullable()->comment("類型");
            $table->string("name")->nullable()->comment("名稱");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
