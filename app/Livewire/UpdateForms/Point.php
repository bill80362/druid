<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Point extends Component
{
    public $pointId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate(['required','integer','min:1'])]
    public string $point = "";
    #[Validate([])]
    public string $member_id = "";
    #[Validate([])]
    public string $order_id = "";
    #[Validate([])]
    public string $discount_id = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->pointId = $id;
        //
        $item = \App\Models\Point::user()->find($this->pointId);
        $this->name = $item?->name ?? "";
        $this->point = $item?->point ?? "";
        $this->member_id = $item?->member_id ?? "";
        $this->order_id = $item?->order_id ?? "";
        $this->discount_id = $item?->discount_id ?? "";
    }

    public function submit()
    {
        //
        $this->actionMessage = "";
        //
        //if(!$this->pointId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\Point::user()->findOrNew($this->pointId);
        $item->name = $this->name;
        $item->point = $this->point;
        $item->member_id = (int)$this->member_id;
        $item->order_id = (int)$this->order_id;
        $item->discount_id = (int)$this->discount_id;
        $item->save();
        //
        if ($this->pointId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('points.edit', ["point" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.point');
    }
}
