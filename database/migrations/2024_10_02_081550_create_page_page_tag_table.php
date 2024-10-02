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
        Schema::create('page_page_tag', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger("page_id")->unsigned();
            $table->bigInteger("page_tag_id")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_page_tag');
    }
};
