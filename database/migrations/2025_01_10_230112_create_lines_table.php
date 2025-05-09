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
        Schema::create('lines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("name")->nullable()->comment("名稱");
            $table->char("status",1)->default("Y")->comment("狀態");
            $table->string("secret")->nullable()->comment("secret");
            $table->string("access_token")->nullable()->comment("access_token");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lines');
    }
};
