<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GoodsDetail extends Component
{
    public $goodsDetailId = null;

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
    #[Validate([], as: '規格')]
    public array $spec_options = [];
    //
    public array $statusText = [
        "Y" => "顯示",
        "N" => "隱藏",
    ];
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->goodsDetailId = $id;
        //
        $item = \App\Models\GoodsDetail::with(["specs","specOptions"])->find($this->goodsDetailId);
        $this->name = $item?->name ?? "";
        $this->sku = $item?->sku ?? "";
        $this->price = $item?->price ?? "";
        $this->status = $item?->status ?? "";
        $this->sort = $item?->sort ?? "";
        $this->spec_options = $item?->specOptions?->toArray()??[];
    }

    public function submit()
    {
        $this->validate();
        //
        $item = \App\Models\GoodsDetail::findOrNew($this->goodsDetailId);
        $item->name = $this->name;
        $item->sku = $this->sku;
        $item->price = $this->price;
        $item->status = $this->status;
        $item->sort = $this->sort;
        $item->save();
        //
        if ($this->goodsDetailId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('goods_details.edit', ["goods_detail" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.goods_detail');
    }
}
