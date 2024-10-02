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
        Schema::create('page_custom_field_values', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //
            $table->unsignedBigInteger("page_tag_custom_field_id")->index();
            //
            $table->unsignedBigInteger("page_id")->index();
            $table->string("value")->nullable()->comment("值");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_custom_field_values');
    }
};
