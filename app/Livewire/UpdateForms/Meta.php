<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Meta extends Component
{
    public $metaId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate([])]
    public string $status = "";
    #[Validate([])]
    public string $page_id = "";
    #[Validate([])]
    public string $access_token = "";
    #[Validate([])]
    public string $secret = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->metaId = $id;
        //
        $item = \App\Models\Meta::find($this->metaId);
        $this->name = $item?->name ?? "";
        $this->status = $item?->status ?? "";
        $this->page_id = $item?->page_id ?? "";
        $this->access_token = $item?->access_token ?? "";
        $this->secret = $item?->secret ?? "";
    }

    public function submit()
    {
        //
        //if(!$this->metaId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\Meta::findOrNew($this->metaId);
        $item->name = $this->name;
        $item->status = $this->status;
        $item->page_id = $this->page_id;
        $item->access_token = $this->access_token;
        $item->secret = $this->secret;
        $item->save();
        //
        if ($this->metaId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('metas.edit', ["meta" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.meta');
    }
}
