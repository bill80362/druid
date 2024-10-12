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
        Schema::create('spec_options', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("name")->nullable()->comment("名稱");
            $table->string("sku")->nullable()->comment("SKU");
            $table->string("content")->nullable()->comment("描述");
            $table->char("status",1)->nullable()->comment("狀態");
            $table->integer("sort")->default(1)->comment("排序");
            $table->unsignedBigInteger("spec_id")->nullable()->comment("規格群組");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spec_options');
    }
};
