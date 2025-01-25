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
        //
        $g = \App\Models\PermissionGroup::findOrNew(16);
        $g->id = 16;
        $g->name = "付款方式管理";
        $g->save();
        //
        $p = \App\Models\Permission::findOrNew(61);
        $p->id = 61;
        $p->permission_group_id = $g->id;
        $p->name = "讀取";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(62);
        $p->id = 62;
        $p->permission_group_id = $g->id;
        $p->name = "新增";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(63);
        $p->id = 63;
        $p->permission_group_id = $g->id;
        $p->name = "修改";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(64);
        $p->id = 64;
        $p->permission_group_id = $g->id;
        $p->name = "刪除";
        $p->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
