<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LineMessages extends Component
{
    public $lineMessagesId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $line_id = "";
    #[Validate([])]
    public string $status = "";
    #[Validate([])]
    public string $type = "";
    #[Validate([])]
    public string $message = "";
    #[Validate([])]
    public string $member_line_id = "";
    #[Validate([])]
    public string $message_at = "";
    #[Validate([])]
    public string $log = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->lineMessagesId = $id;
        //
        $item = \App\Models\LineMessages::user()->find($this->lineMessagesId);
        $this->line_id = $item?->line_id ?? "";
        $this->status = $item?->status ?? "";
        $this->type = $item?->type ?? "";
        $this->message = $item?->message ?? "";
        $this->member_line_id = $item?->member_line_id ?? "";
        $this->message_at = $item?->message_at ?? "";
        $this->log = $item?->log ?? "";
    }

    public function submit()
    {
        $this->actionMessage = "";
        //
        //if(!$this->lineMessagesId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\LineMessages::user()->findOrNew($this->lineMessagesId);
        $item->line_id = $this->line_id;
        $item->status = $this->status;
        $item->type = $this->type;
        $item->message = $this->message;
        $item->member_line_id = $this->member_line_id;
        $item->message_at = $this->message_at;
        $item->log = $this->log;
        $item->save();
        //
        if ($this->lineMessagesId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('line_messages.edit', ["line_message" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.line_messages');
    }
}
