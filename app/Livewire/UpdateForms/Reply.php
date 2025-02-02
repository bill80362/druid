<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Reply extends Component
{
    public $replyId = null;

    #[Validate(['required','min:1','max:20'], as: '偵測文字')]
    public string $name = "";
    //line限定回應文字300字
    #[Validate(['required','min:1','max:250'], as: '回應訊息')]
    public string $content = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->replyId = $id;
        //
        $item = \App\Models\Reply::find($this->replyId);
        $this->name = $item?->name ?? "";
        $this->content = $item?->content ?? "";
    }

    public function submit()
    {
        //
        //if(!$this->replyId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\Reply::findOrNew($this->replyId);
        $item->name = $this->name;
        $item->content = $this->content;
        $item->save();
        //
        if ($this->replyId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('replies.edit', ["reply" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.reply');
    }
    public function addPointText()
    {
        $this->content .= '{{$point}}';
    }
    public function addMemberNameText()
    {
        $this->content .= '{{$member_name}}';
    }
    public function addMemberPhoneText()
    {
        $this->content .= '{{$member_phone}}';
    }
    public function addMemberLevelText()
    {
        $this->content .= '{{$member_level}}';
    }
    public function addMemberUpgradeGapText()
    {
        $this->content .= '{{$member_upgrade_gap}}';
    }
}
