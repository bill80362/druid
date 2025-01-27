<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Level extends Component
{
    public $levelId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate(['required','unique:levels,sort'], as: '等級排序')]
    public string $sort = "";
    #[Validate([])]
    public string $upgrade = "";
    #[Validate([])]
    public string $degrade = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->levelId = $id;
        //
        $item = \App\Models\Level::find($this->levelId);
        $this->name = $item?->name ?? "";
        $this->sort = $item?->sort ?? "";
        $this->upgrade = $item?->upgrade ?? "";
        $this->degrade = $item?->degrade ?? "";
    }

    public function submit()
    {
        //
        //if(!$this->levelId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\Level::findOrNew($this->levelId);
        $item->name = $this->name;
        $item->sort = $this->sort;
        $item->upgrade = $this->upgrade;
        $item->degrade = $this->degrade;
        $item->save();
        //
        if ($this->levelId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('levels.edit', ["level" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.level');
    }
}
