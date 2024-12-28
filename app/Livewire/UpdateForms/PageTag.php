<?php

namespace App\Livewire\UpdateForms;

use App\Models\PageTagCustomField;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PageTag extends Component
{
    public $pageTagId = null;

    #[Validate(['required', 'min:4', 'max:20'], as: '名稱')]
    public string $name = "";
    #[Validate([])]
    public string $content = "";
    //
    public array $pages = [];
    //
    public array $customFields = [];
    //
    public array $customFieldNew = [
        "name" => "",
        "sort" => 1,
        "type" => "text",
        "options" => "",
    ];
    //
    public string $actionMessage = "";


    public function mount($id)
    {
        //
        $this->pageTagId = $id;
        //
        $item = \App\Models\PageTag::with(["pages", "customFields"])->find($this->pageTagId);
        $this->name = $item?->name ?? "";
        $this->content = $item?->content ?? "";
        $this->pages = $item?->pages->pluck("id")->toArray() ?? [];
        $this->customFields = $item?->customFields->sortByDesc("sort")->toArray() ?? [];
    }

    public function submit()
    {
        $this->validate();
        //
        $item = \App\Models\PageTag::findOrNew($this->pageTagId);
        $item->name = $this->name;
        $item->content = $this->content;
        $item->save();
        //
        $item->pages()->sync($this->pages);
        $item->customFields()->saveMany(collect($this->customFields)->transform(function($value){
            $o = PageTagCustomField::findOrNew($value["id"]);
            $o->name = $value["name"];
            $o->sort = $value["sort"];
            $o->type = $value["type"];
            $o->options = $value["options"];
            return $o;
        }));
        //
        if (!empty($this->customFieldNew["name"])) {
            $o = new PageTagCustomField();
            $o->name = $this->customFieldNew["name"];
            $o->sort = $this->customFieldNew["sort"];
            $o->type = $this->customFieldNew["type"];
            $o->options = $this->customFieldNew["options"];
            $item->customFields()->save($o);
            //
            $this->customFieldNew = [
                "name" => "",
                "sort" => 1,
                "type" => "text",
                "options" => "",
            ];
        }
        //
        if ($this->pageTagId) {
            $this->actionMessage = "更新成功";
            return redirect()->route('page_tags.edit', ["page_tag" => $item]);
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('page_tags.edit', ["page_tag" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.page_tag', [
            "pageOptions" => \App\Models\Page::get(),
        ]);
    }
}
