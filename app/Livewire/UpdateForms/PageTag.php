<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PageTag extends Component
{
    public $pageTagId = null;

    #[Validate(['required','min:4','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate([])]
    public string $content = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->pageTagId = $id;
        //
        $item = \App\Models\PageTag::find($this->pageTagId);
        $this->name = $item?->name ?? "";
        $this->content = $item?->content ?? "";
    }

    public function submit()
    {
        //
        //if(!$this->pageTagId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\PageTag::findOrNew($this->pageTagId);
        $item->name = $this->name;
        $item->content = $this->content;
        $item->save();
        //
        if ($this->pageTagId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('page_tags.edit', ["page_tag" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.page_tag');
    }
}