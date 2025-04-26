<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SpecOption extends Component
{
    public $specOptionId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate([],as: 'SKU')]
    public string $sku = "";
    #[Validate([],as: '描述')]
    public string $content = "";
    #[Validate(['required'],as: '狀態')]
    public string $status = "";
    #[Validate(['required'],as: '規格群組')]
    public string $spec_id = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->specOptionId = $id;
        //
        $item = \App\Models\SpecOption::user()->with(["spec"])->find($this->specOptionId);
        $this->name = $item?->name ?? "";
        $this->content = $item?->content ?? "";
        $this->status = $item?->status ?? "";
        $this->spec_id = $item?->spec_id ?? "";
    }

    public function submit()
    {
        //
        $this->actionMessage = "";
        //
        $this->validate();
        //
        $item = \App\Models\SpecOption::user()->findOrNew($this->specOptionId);
        $item->name = $this->name;
        $item->sku = $this->sku;
        $item->content = $this->content;
        $item->status = $this->status;
        $item->spec_id = $this->spec_id;
        $item->save();
        //
        if ($this->specOptionId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('spec_options.edit', ["spec_option" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.spec_option',[
            "specOptions" => \App\Models\Spec::get(),
        ]);
    }
}
