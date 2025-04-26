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
//    #[Validate([])]
    public string $coupon_code = "";
    #[Validate([])]
    public string $status = "";
    #[Validate(["required","date"], as: "折扣時段開始")]
    public string $discount_start = "";
    #[Validate(["required","date","after_or_equal:discount_start"], as: "折扣時段結束")]
    public string $discount_end = "";
    #[Validate(["in:M,R"], as: '類型')]
    public string $coupon_type = "";
    #[Validate(["required_if:coupon_type,==,M","integer","min:1","max:2000"],as: '折抵多少錢', message: ["required_if"=>"當類型為折抵時候必填"])]
    public string $discount_money = "";
    #[Validate(["required_if:coupon_type,==,R","integer","min:50","max:100"],as: '打幾折%', message: ["required_if"=>"當類型為打折時候必填"])]
    public string $discount_ratio = "";
    //
    public string $actionMessage = "";
    //
    public function rules(): array
    {
        return [
            'coupon_code' => 'required|unique:coupons,coupon_code,'.$this->couponId.',id',
        ];
    }

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
        $this->actionMessage = "";
        //
        //if(!$this->couponId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $validated = $this->validate();
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
