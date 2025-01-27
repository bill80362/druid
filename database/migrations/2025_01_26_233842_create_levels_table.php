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
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer("sort")->default(1)->comment("等級順序");
            $table->string("name")->nullable()->comment("名稱");
            $table->integer("upgrade")->comment("升等門檻");
            $table->integer("degrade")->comment("續等門檻");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
