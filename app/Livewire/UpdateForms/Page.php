<?php

namespace App\Livewire\UpdateForms;

use App\Models\PageCustomFieldValue;
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
    #[Validate(["required"], as : '標籤')]
    public string $page_tag_id = "";
    #[Validate([])]
    public array $customFields = [];
    #[Validate([])]
    public array $customFieldValue = [];
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->pageId = $id;
        //
        $item = \App\Models\Page::with(["pageTag.customFields","customFieldValue.customField"])->find($this->pageId);
        $this->name = $item?->name ?? "";
        $this->content = $item?->content ?? "";
        $this->page_tag_id = $item?->page_tag_id ?? "";
        $this->customFields = $item?->pageTag?->customFields?->sortByDesc("sort")->toArray() ?? [];
        $this->customFieldValue = $item?->customFieldValue?->keyBy("page_tag_custom_field_id")->toArray() ?? [];
    }

    public function submit()
    {
        $this->actionMessage = "";
        //
        $this->validate();
        //
        $item = \App\Models\Page::findOrNew($this->pageId);
        $item->name = $this->name;
        $item->content = $this->content;
        $item->page_tag_id = $this->page_tag_id;
        $item->save();
        //
        $item->customFieldValue()->saveMany(collect($this->customFieldValue)->transform(function ($value,$key)use($item){
            $o = PageCustomFieldValue::where("page_id",$item->id)->where("page_tag_custom_field_id",$key)->firstOrNew();
            $o->page_tag_custom_field_id = $key;
            $o->value = $value["value"];
            return $o;
        }));
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
            "pageTags" => \App\Models\PageTag::get(),
        ]);
    }
}
