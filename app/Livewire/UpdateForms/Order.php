<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use App\Models\Setting;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Order extends Component
{
    public $orderId = null;

    #[Validate(['required','in:created,pay,ship,cod,arrive,delivery,finish,cancel'], as: '狀態')]
    public string $status = "";
    #[Validate([])]
    public int $detail_subtotal = 0;
    #[Validate([])]
    public int $payment_fee = 0;
    #[Validate([])]
    public int $shipping_fee = 0;
    #[Validate([])]
    public int $coupon_discount = 0;
    #[Validate([])]
    public int $total = 0;
    #[Validate([])]
    public string $buyer_name = "";
    #[Validate([])]
    public string $buyer_phone = "";
    #[Validate([])]
    public string $receiver_name = "";
    #[Validate([])]
    public string $receiver_phone = "";
    #[Validate([])]
    public string $receiver_postal_code = "";
    #[Validate([])]
    public string $receiver_address = "";
    #[Validate([])]
    public string $receiver_memo = "";
    #[Validate([])]
    public string $memo = "";
    #[Validate([])]
    public string $memo_admin = "";
    #[Validate([])]
    public string $promotion_code = "";
    #[Validate([])]
    public string $created_at = "";
    #[Validate([])]
    public string $member_id = "";
    //
    public mixed $member;
    public mixed $points;
    public mixed $orderPayments;
    public mixed $orderDetails;
    public mixed $coupon;
    public int $pointToMoney;
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->orderId = $id;
        //系統設定
        $setting = Setting::user()->first();
        $systemSetting = $setting?->content;
        $this->pointToMoney = (int)($systemSetting["point_to_money"]??1);
        //
        $item = \App\Models\Order::user()->with(["member.level","points","orderPayments.payment","orderDetails.goodsDetail","coupon"])->find($this->orderId);
        $this->status = $item?->status ?? "";
        $this->detail_subtotal = $item?->detail_subtotal ?? 0;
        $this->payment_fee = $item?->payment_fee ?? 0;
        $this->shipping_fee = $item?->shipping_fee ?? 0;
        $this->coupon_discount = $item?->coupon_discount ?? 0;
        $this->total = $item?->total ?? 0;
        $this->buyer_name = $item?->buyer_name ?? "";
        $this->buyer_phone = $item?->buyer_phone ?? "";
        $this->receiver_name = $item?->receiver_name ?? "";
        $this->receiver_phone = $item?->receiver_phone ?? "";
        $this->receiver_postal_code = $item?->receiver_postal_code ?? "";
        $this->receiver_address = $item?->receiver_address ?? "";
        $this->receiver_memo = $item?->receiver_memo ?? "";
        $this->memo = $item?->memo ?? "";
        $this->memo_admin = $item?->memo_admin ?? "";
        $this->created_at = $item?->created_at ?? "";
        $this->member_id = $item?->member_id ?? "";
        //
        $this->member = $item?->member;
        $this->points = $item?->points;
        $this->orderPayments = $item?->orderPayments;
        $this->orderDetails = $item?->orderDetails;
        $this->coupon = $item?->coupon;
    }

    public function submit()
    {
        $this->actionMessage = "";
        //
        //if(!$this->orderId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\Order::with(["member"])->findOrNew($this->orderId);
        $item->status = $this->status;
        $item->detail_subtotal = $this->detail_subtotal ?? 0;
        $item->payment_fee = $this->payment_fee ?? 0;
        $item->shipping_fee = $this->shipping_fee ?? 0;
        $item->coupon_discount = $this->coupon_discount ?? 0;
        $item->total = $this->total ?? 0;
        $item->buyer_name = $this->buyer_name ?? "";
        $item->buyer_phone = $this->buyer_phone ?? "";
        $item->receiver_name = $this->receiver_name ?? "";
        $item->receiver_phone = $this->receiver_phone ?? "";
        $item->receiver_postal_code = $this->receiver_postal_code ?? "";
        $item->receiver_address = $this->receiver_address ?? "";
        $item->receiver_memo = $this->receiver_memo ?? "";
        $item->memo = $this->memo ?? "";
        $item->memo_admin = $this->memo_admin ?? "";
//        $item->member_id = $this->member_id ?? "";
        $item->save();
        //
        $this->member = $item?->member;
        //
        if ($this->orderId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('orders.edit', ["order" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.order');
    }
}
