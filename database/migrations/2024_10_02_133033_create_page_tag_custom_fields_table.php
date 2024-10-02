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
        Schema::create('page_tag_custom_fields', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger("page_tag_id")->index();
            $table->unsignedInteger("sort")->comment("排序");
            $table->char("type","15")->comment("類型");
            $table->string("name")->nullable()->comment("名稱");
            $table->text("options")->nullable()->comment("選項");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_tag_custom_fields');
    }
};
