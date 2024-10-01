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
        $g = \App\Models\PermissionGroup::findOrNew(3);
        $g->id = 3;
        $g->name = "頁面標籤管理";
        $g->save();
        //
        $p = \App\Models\Permission::findOrNew(9);
        $p->id = 9;
        $p->permission_group_id = $g->id;
        $p->name = "讀取";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(10);
        $p->id = 10;
        $p->permission_group_id = $g->id;
        $p->name = "新增";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(11);
        $p->id = 11;
        $p->permission_group_id = $g->id;
        $p->name = "修改";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(12);
        $p->id = 12;
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
