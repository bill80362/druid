<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Coupon extends Component
{
    public $couponId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate([])]
    public string $coupon_code = "";
    #[Validate([])]
    public string $status = "";
    #[Validate([])]
    public string $discount_start = "";
    #[Validate([])]
    public string $discount_end = "";
    #[Validate([])]
    public string $coupon_type = "";
    #[Validate([])]
    public string $discount_money = "";
    #[Validate([])]
    public string $discount_ratio = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->couponId = $id;
        //
        $item = \App\Models\Coupon::user()->find($this->couponId);
        $this->name = $item?->name ?? "";
        $this->coupon_code = $item?->coupon_code ?? "";
        $this->status = $item?->status ?? "Y";
        $this->discount_start = $item?->discount_start->format("Y-m-d") ?? date("Y-m-d");
        $this->discount_end = $item?->discount_end->format("Y-m-d") ?? date("Y-m-d",strtotime("+1 months"));
        $this->coupon_type = $item?->coupon_type ?? "M";
        $this->discount_money = $item?->discount_money??"";
        $this->discount_ratio = $item?->discount_ratio??"";
    }

    public function submit()
    {
        //
        //if(!$this->couponId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\Coupon::user()->findOrNew($this->couponId);
        $item->name = $this->name;
        $item->coupon_code = $this->coupon_code;
        $item->status = $this->status;
        $item->discount_start = $this->discount_start;
        $item->discount_end = $this->discount_end;
        $item->coupon_type = $this->coupon_type;
        $item->discount_money = $this->discount_money?:null;
        $item->discount_ratio = $this->discount_ratio?:null;
        $item->save();
        //
        if ($this->couponId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('coupons.edit', ["coupon" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.coupon');
    }
}
