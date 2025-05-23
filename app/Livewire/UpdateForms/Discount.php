<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Discount extends Component
{
    public $discountId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate([])]
    public string $status = "";
    #[Validate(["required","date"], as: "折扣時段開始")]
    public string $discount_start = "";
    #[Validate(["required","date","after_or_equal:discount_start"], as: "折扣時段結束")]
    public string $discount_end = "";
    #[Validate(['required','integer','min:1',], as: '折扣計算順序')]
    public string $sort = "";
    #[Validate([])]
    public string $event_type = "";
    #[Validate([])]
    public string|null $level_id = "";
    #[Validate([
        "required_if:event_type,==,C",
        "required_if:event_type,==,E",
        "required_if:event_type,==,B",
        "integer","min:1",
    ],as: '滿件門檻', message: ["required_if"=>"滿件門檻為必填"])]
    public string $event_count_threshold = "";
    #[Validate([
        "required_if:event_type,==,M",
        "required_if:event_type,==,E",
        "required_if:event_type,==,B",
        "integer","min:1",
    ],as: '滿額門檻', message: ["required_if"=>"滿額門檻為必填"])]
    public string $event_money_threshold = "";
    #[Validate([])]
    public string $discount_goods_status = "";
    #[Validate([])]
    public string $discount_goods_sku = "";
    #[Validate(["in:M,R"], as: '類型')]
    public string $discount_type = "";
    #[Validate(["required_if:discount_type,==,M","integer","min:1","max:2000"],as: '折抵多少錢', message: ["required_if"=>"當類型為折抵時候必填"])]
    public string $discount_money = "";
    #[Validate(["required_if:discount_type,==,R","integer","min:50","max:100"],as: '打幾折%',message: ["required_if"=>"當類型為打折時候必填"])]
    public string $discount_ratio = "";
    #[Validate([])]
    public string $discount_static = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->discountId = $id;
        //
        $item = \App\Models\Discount::user()->find($this->discountId);
        $this->name = $item?->name ?? "";
        $this->status = $item?->status ?? "Y";
        $this->discount_start = $item?->discount_start->format("Y-m-d") ?? date("Y-m-d");
        $this->discount_end = $item?->discount_end->format("Y-m-d") ?? date("Y-m-d",strtotime("+1 months"));
        $this->sort = $item?->sort ?? ((int)\App\Models\Discount::max("sort"))+1;
        $this->level_id = $item?->level_id ?? 0;
        $this->event_type = $item?->event_type ?? "N";
        $this->event_count_threshold = $item?->event_count_threshold??"";
        $this->event_money_threshold = $item?->event_money_threshold??"";
        $this->discount_goods_status = $item?->discount_goods_status ?? "N";
        $this->discount_goods_sku = $item?->discount_goods_sku ?? "";
        $this->discount_type = $item?->discount_type ?? "M";
        $this->discount_money = $item?->discount_money??"";
        $this->discount_ratio = $item?->discount_ratio??"";
        $this->discount_static = $item?->discount_static??"";
    }

    public function submit()
    {
        //
        $this->actionMessage = "";
        //
        //if(!$this->discountId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\Discount::user()->findOrNew($this->discountId);
        $item->name = $this->name;
        $item->status = $this->status;
        $item->discount_start = $this->discount_start;
        $item->discount_end = $this->discount_end;
        $item->sort = $this->sort;
        $item->level_id = $this->level_id?:null;
        $item->event_type = $this->event_type;
        $item->event_count_threshold = $this->event_count_threshold?:null;
        $item->event_money_threshold = $this->event_money_threshold?:null;
        $item->discount_goods_status = $this->discount_goods_status;
        $item->discount_goods_sku = $this->discount_goods_sku;
        $item->discount_type = $this->discount_type;
        $item->discount_money = $this->discount_money?:null;
        $item->discount_ratio = $this->discount_ratio?:null;
        $item->discount_static = $this->discount_static?:null;
        $item->save();
        //
        if ($this->discountId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('discounts.edit', ["discount" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.discount');
    }
}
