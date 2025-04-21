<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Line extends Component
{
    public $lineId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate([])]
    public string $status = "";
    #[Validate([])]
    public string $secret = "";
    #[Validate([])]
    public string $access_token = "";
    #[Validate([])]
    public string $liff_id = "";
    #[Validate([])]
    public string $slug = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->lineId = $id;
        //
        $item = \App\Models\Line::user()->find($this->lineId);
        $this->name = $item?->name ?? "";
        $this->status = $item?->status ?? "";
        $this->secret = $item?->secret ?? "";
        $this->access_token = $item?->access_token ?? "";
        $this->liff_id = $item?->liff_id ?? "";
        $this->slug = $item?->slug ?? "";
    }

    public function submit()
    {
        //
        //if(!$this->lineId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\Line::user()->findOrNew($this->lineId);
        $item->name = $this->name;
        $item->status = $this->status;
        $item->secret = $this->secret;
        $item->access_token = $this->access_token;
        $item->liff_id = $this->liff_id;
//        $item->slug = $this->slug;
        $item->save();
        //
        if ($this->lineId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('lines.edit', ["line" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.line');
    }
}
