<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Goods extends Component
{
    public $goodsId = null;

    #[Validate(['required','min:1','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate(['required'], as: 'SKU')]
    public string $sku = "";
    #[Validate([], as: '價格')]
    public string $price = "";
    #[Validate(['required'], as: '狀態')]
    public string $status = "Y";
    #[Validate(['required'], as: '排序')]
    public string $sort = "1";
    //
    public array $statusText = [
        "Y" => "顯示",
        "N" => "隱藏",
    ];
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->goodsId = $id;
        //
        $item = \App\Models\Goods::find($this->goodsId);
        $this->name = $item?->name ?? "";
        $this->sku = $item?->sku ?? "";
        $this->price = $item?->price ?? "";
        $this->status = $item?->status ?? "";
        $this->sort = $item?->sort ?? "";
    }

    public function submit()
    {
        $this->validate();
        //
        $item = \App\Models\Goods::findOrNew($this->goodsId);
        $item->name = $this->name;
        $item->sku = $this->sku;
        $item->price = $this->price;
        $item->status = $this->status;
        $item->sort = $this->sort;
        $item->save();
        //
        if ($this->goodsId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('goods.edit', ["goods" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.goods');
    }
}
