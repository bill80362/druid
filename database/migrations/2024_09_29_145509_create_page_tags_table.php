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
        Schema::create('page_tags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //
            $table->integer('sort')->unsigned()->default(1)->comment("排序");
            $table->string('name')->comment("名稱");
            $table->mediumText('content')->comment("描述");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_tags');
    }
};
