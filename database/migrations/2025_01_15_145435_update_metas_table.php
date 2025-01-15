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
        Schema::table('metas', function (Blueprint $table) {
            $table->string("page_id")->nullable()->comment("專頁id");
            $table->string("secret")->nullable()->comment("secret");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
