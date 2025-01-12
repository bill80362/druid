<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MetaMessages extends Component
{
    public $metaMessagesId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $meta_id = "";
    #[Validate([])]
    public string $status = "";
    #[Validate([])]
    public string $type = "";
    #[Validate([])]
    public string $message = "";
    #[Validate([])]
    public string $member_meta_id = "";
    #[Validate([])]
    public string $message_at = "";
    #[Validate([])]
    public string $log = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->metaMessagesId = $id;
        //
        $item = \App\Models\MetaMessage::find($this->metaMessagesId);
        $this->meta_id = $item?->meta_id ?? "";
        $this->status = $item?->status ?? "";
        $this->type = $item?->type ?? "";
        $this->message = $item?->message ?? "";
        $this->member_meta_id = $item?->member_meta_id ?? "";
        $this->message_at = $item?->message_at ?? "";
        $this->log = $item?->log ?? "";
    }

    public function submit()
    {
        //
        //if(!$this->metaMessagesId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\MetaMessage::findOrNew($this->metaMessagesId);
        $item->meta_id = $this->meta_id;
        $item->status = $this->status;
        $item->type = $this->type;
        $item->message = $this->message;
        $item->member_meta_id = $this->member_meta_id;
        $item->message_at = $this->message_at;
        $item->log = $this->log;
        $item->save();
        //
        if ($this->metaMessagesId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('meta_messages.edit', ["meta_message" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.meta_messages');
    }
}
