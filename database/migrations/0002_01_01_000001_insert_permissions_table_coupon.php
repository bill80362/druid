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
        $g = \App\Models\PermissionGroup::findOrNew(22);
        $g->id = 22;
        $g->name = "優惠券管理";
        $g->save();
        //
        $p = \App\Models\Permission::findOrNew(85);
        $p->id = 85;
        $p->permission_group_id = $g->id;
        $p->name = "讀取";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(86);
        $p->id = 86;
        $p->permission_group_id = $g->id;
        $p->name = "新增";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(87);
        $p->id = 87;
        $p->permission_group_id = $g->id;
        $p->name = "修改";
        $p->save();
        //
        $p = \App\Models\Permission::findOrNew(88);
        $p->id = 88;
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
