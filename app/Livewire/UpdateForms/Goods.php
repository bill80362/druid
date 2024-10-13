<?php

namespace App\Livewire\UpdateForms;

use App\Models\GoodsSepcOption;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Goods extends Component
{
    public $goodsId = null;

    #[Validate(['required', 'min:1', 'max:20'], as: '名稱')]
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
    public array $specIds = [];
    //
    public array $details = [];
    //
    public array $detailCanBuilds = [];
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
        $item = \App\Models\Goods::with(["specs.specOptions", "specOptions"])->find($this->goodsId);
        $this->name = $item?->name ?? "";
        $this->sku = $item?->sku ?? "";
        $this->price = $item?->price ?? "";
        $this->status = $item?->status ?? "";
        $this->sort = $item?->sort ?? "";
        $this->specIds = $item?->specs->pluck("id")->toArray() ?? [];
        //載入商品明細列表
        $this->details = $this->loadSpecOptions($item->specOptions ?? []);
        //建議新增
        $this->detailCanBuilds = $this->loadDetailCanBuilds($item->specs ?? [], $item->name, $item->sku, $item->price, $item->status);

    }

    public function loadSpecOptions($specOptions): array
    {
        $detail = [];
        foreach ($specOptions as $specOption) {
            $detail[$specOption->sku] = $specOption->toArray();
        }
        return $detail;
    }

    public function loadDetailCanBuilds($specs, $defaultName, $defaultSku, $defaultPrice, $defaultStatus): array
    {
        $detailCanBuilds = [];
        foreach ($specs as $specIndex => $spec) {
            $temp = [];
            foreach ($spec->specOptions ?? [] as $specOptionIndex => $specOption) {
                if ($specIndex) {
                    //第二圈開始數量要等比上升
                    foreach ($detailCanBuilds as $detailCanBuild) {
                        $temp[] = [
                            "name" => $detailCanBuild["name"] . $specOption->name,
                            "sku" => $detailCanBuild["sku"] . $specOption->sku,
                            "price" => $defaultPrice,
                            "status" => $defaultStatus,
                            "sort" => 1,
                        ];
                    }
                } else {
                    //第一圈，初始化第一批
                    $temp[] = [
                        "name" => $defaultName . $specOption->name,
                        "sku" => $defaultSku . $specOption->sku,
                        "price" => $defaultPrice,
                        "status" => $defaultStatus,
                        "sort" => 1,
                    ];
                }
            }
            $detailCanBuilds = $temp;
        }
        return $detailCanBuilds;
    }

    public function submit()
    {
        $this->validate();
        //
        $item = \App\Models\Goods::with(["specs"])->findOrNew($this->goodsId);
        $item->name = $this->name;
        $item->sku = $this->sku;
        $item->price = $this->price;
        $item->status = $this->status;
        $item->sort = $this->sort;
        $item->save();
        //
        $item->specs()->sync($this->specIds);
        //
        if ($this->goodsId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('goods.edit', ["goods" => $item]);
        }
    }

    public function updateDetails()
    {
        //
        dd($this->details);
    }

    public function createDetail($key)
    {
        //
        $item = \App\Models\Goods::find($this->goodsId);
        //
        if (empty($this->detailCanBuilds[$key]["sku"])) return;
        //
        $detail = GoodsSepcOption::where("sku", $this->detailCanBuilds[$key]["sku"])->firstOrNew();
        $detail->sku = $this->detailCanBuilds[$key]["sku"];
        $detail->name = $this->detailCanBuilds[$key]["name"];
        $detail->price = $this->detailCanBuilds[$key]["price"];
        $detail->status = $this->detailCanBuilds[$key]["status"];
        $detail->sort = 1;
        $item->specOptions()->save($detail);
        //新增成功就刪掉
        unset($this->detailCanBuilds[$key]);
        //重新載入商品明細列表
        $this->details = $this->loadSpecOptions($item->specOptions ?? []);
    }

    public function render()
    {
        //
        return view('livewire.update-forms.goods', [
            "specOptions" => \App\Models\Spec::get(),
        ]);
    }
}
