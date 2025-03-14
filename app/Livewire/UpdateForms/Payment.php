<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Payment extends Component
{
    public $paymentId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate([])]
    public string $status = "";
    #[Validate([])]
    public string $type = "N";
    #[Validate([])]
    public string $sort = "";
    #[Validate([])]
    public string $line_pay_channel_id = "";
    #[Validate([])]
    public string $line_pay_channel_secret = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->paymentId = $id;
        //
        $item = \App\Models\Payment::find($this->paymentId);
        $this->name = $item?->name ?? "";
        $this->status = $item?->status ?? "";
        $this->type = $item?->type ?? "N";
        $this->sort = $item?->sort ?? "1";
        $this->line_pay_channel_id = $item?->line_pay_channel_id ?? "";
        $this->line_pay_channel_secret = $item?->line_pay_channel_secret ?? "";
    }

    public function submit()
    {
        //
        //if(!$this->paymentId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\Payment::findOrNew($this->paymentId);
        $item->name = $this->name;
        $item->status = $this->status;
        $item->type = $this->type;
        $item->sort = $this->sort;
        $item->line_pay_channel_id = $this->line_pay_channel_id;
        $item->line_pay_channel_secret = $this->line_pay_channel_secret;
        $item->save();
        //
        if ($this->paymentId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('payments.edit', ["payment" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.payment');
    }
}
