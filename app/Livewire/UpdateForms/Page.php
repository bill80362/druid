<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Page extends Component
{
    public $pageId = null;

    #[Validate(['required','min:4','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate([])]
    public string $content = "";
    //
    public string $actionMessage = "";

    public array $tags = [];

    public function mount($id)
    {
        $this->pageId = $id;
        //
        $item = \App\Models\Page::with(["tags"])->find($this->pageId);
        $this->name = $item?->name ?? "";
        $this->content = $item?->content ?? "";
        $this->tags = $item?->tags->pluck("id")->toArray() ?? [];
    }

    public function submit()
    {
        $this->validate();
        //
        $item = \App\Models\Page::findOrNew($this->pageId);
        $item->name = $this->name;
        $item->content = $this->content;
        $item->save();
        //
        $item->tags()->sync($this->tags);
        //
        if ($this->pageId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('pages.edit', ["page" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.page',[
            "pageTags" => \App\Models\PageTag::get()
        ]);
    }
}
