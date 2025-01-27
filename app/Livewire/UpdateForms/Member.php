<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Member extends Component
{
    public $memberId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate([])]
    public string $status = "";
    #[Validate([])]
    public string $account = "";
    #[Validate([])]
    public string $password = "";
    #[Validate([])]
    public string $line_id = "";
    #[Validate([])]
    public string $phone = "";
    #[Validate([])]
    public string $postal_code = "";
    #[Validate([])]
    public string $address = "";
    #[Validate([])]
    public string $level_id = "";

    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->memberId = $id;
        //
        $item = \App\Models\Member::find($this->memberId);
        $this->name = $item?->name ?? "";
        $this->status = $item?->status ?? "";
        $this->account = $item?->account ?? "";
        $this->password = $item?->password ?? "";
        $this->line_id = $item?->line_id ?? "";
        $this->phone = $item?->phone ?? "";
        $this->postal_code = $item?->postal_code ?? "";
        $this->address = $item?->address ?? "";
        $this->level_id = $item?->level_id ?? "";
    }

    public function submit()
    {
        //
        //if(!$this->memberId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\Member::findOrNew($this->memberId);
        $item->name = $this->name;
        $item->status = $this->status;
        $item->account = $this->account;
        $item->password = $this->password;
        $item->line_id = $this->line_id;
        $item->phone = $this->phone;
        $item->postal_code = $this->postal_code;
        $item->address = $this->address;
        $item->level_id = $this->level_id;
        $item->save();
        //
        if ($this->memberId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('members.edit', ["member" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.member');
    }
}
