<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Spec extends Component
{
    public $specId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate([], as: '描述')]
    public string $content = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->specId = $id;
        //
        $item = \App\Models\Spec::find($this->specId);
        $this->name = $item?->name ?? "";
        $this->content = $item?->content ?? "";
    }

    public function submit()
    {
        //
        //if(!$this->specId){
        //    $this->validate([
        //        "name" => ["required"],
        //        "content" => ["required"],
        //    ]);
        //}else{
        //    $this->validate();
        //}
        $this->validate();
        //
        $item = \App\Models\Spec::findOrNew($this->specId);
        $item->name = $this->name;
        $item->content = $this->content;
        $item->save();
        //
        if ($this->specId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('specs.edit', ["spec" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.spec');
    }
}
