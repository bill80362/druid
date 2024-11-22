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
        $g = \App\Models\PermissionGroup::findOrNew(9);
        $g->id = 9;
        $g->name = "存證信函管理";
        $g->save();
        //
        $p = \App\Models\Permission::findOrNew(33);
        $p->id = 33;
        $p->permission_group_id = $g->id;
        $p->name = "讀取";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(34);
        $p->id = 34;
        $p->permission_group_id = $g->id;
        $p->name = "新增";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(35);
        $p->id = 35;
        $p->permission_group_id = $g->id;
        $p->name = "修改";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(36);
        $p->id = 36;
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
