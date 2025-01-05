<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Order extends Component
{
    public $orderId = null;

    #[Validate(['required','in:created,pay,ship,cod,arrive,delivery,finish,cancel'], as: '狀態')]
    public string $status = "";
    #[Validate([])]
    public string $detail_subtotal = "";
    #[Validate([])]
    public string $payment_fee = "";
    #[Validate([])]
    public string $shipping_fee = "";
    #[Validate([])]
    public string $total = "";
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
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->orderId = $id;
        //
        $item = \App\Models\Order::with(["member"])->find($this->orderId);
        $this->status = $item?->status ?? "";
        $this->detail_subtotal = $item?->detail_subtotal ?? "";
        $this->payment_fee = $item?->payment_fee ?? "";
        $this->shipping_fee = $item?->shipping_fee ?? "";
        $this->total = $item?->total ?? "";
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
    }

    public function submit()
    {
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
        $item->detail_subtotal = $this->detail_subtotal ?? "";
        $item->payment_fee = $this->payment_fee ?? "";
        $item->shipping_fee = $this->shipping_fee ?? "";
        $item->total = $this->total ?? "";
        $item->buyer_name = $this->buyer_name ?? "";
        $item->buyer_phone = $this->buyer_phone ?? "";
        $item->receiver_name = $this->receiver_name ?? "";
        $item->receiver_phone = $this->receiver_phone ?? "";
        $item->receiver_postal_code = $this->receiver_postal_code ?? "";
        $item->receiver_address = $this->receiver_address ?? "";
        $item->receiver_memo = $this->receiver_memo ?? "";
        $item->memo = $this->memo ?? "";
        $item->memo_admin = $this->memo_admin ?? "";
        $item->member_id = $this->member_id ?? "";
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
