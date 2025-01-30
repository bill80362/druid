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
        $g = \App\Models\PermissionGroup::findOrNew(19);
        $g->id = 19;
        $g->name = "點數管理";
        $g->save();
        //
        $p = \App\Models\Permission::findOrNew(73);
        $p->id = 73;
        $p->permission_group_id = $g->id;
        $p->name = "讀取";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(74);
        $p->id = 74;
        $p->permission_group_id = $g->id;
        $p->name = "新增";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(75);
        $p->id = 75;
        $p->permission_group_id = $g->id;
        $p->name = "修改";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(76);
        $p->id = 76;
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
