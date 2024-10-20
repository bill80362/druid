<?php

namespace App\Livewire\UpdateForms;

use App\Models\GoodsDetail;
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
        //載入商品
        $item = \App\Models\Goods::with([
            "specs.specOptions",
            "goodsDetails.specs",
            "goodsDetails.specOptions",
        ])->find($this->goodsId);
        $this->name = $item?->name ?? "";
        $this->sku = $item?->sku ?? "";
        $this->price = $item?->price ?? "";
        $this->status = $item?->status ?? "";
        $this->sort = $item?->sort ?? "";
        $this->specIds = $item?->specs->pluck("id")->toArray() ?? [];
        //載入商品明細列表
        $this->details = $this->loadSpecOptions($item->goodsDetails ?? []);
        //建議新增
        $this->detailCanBuilds = $this->loadDetailCanBuilds($item->specs ?? [], $item?->name, $item?->sku, $item?->price, $item?->status,array_keys($this->details));
    }

    public function loadSpecOptions($goodsDetails): array
    {
        $detail = [];
        foreach ($goodsDetails as $goodsDetail) {
            $detail[$goodsDetail->sku] = $goodsDetail->toArray();
        }
        return $detail;
    }

    public function loadDetailCanBuilds($specs, $defaultName, $defaultSku, $defaultPrice, $defaultStatus, $skuExclude): array
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
                            "spec" => array_merge($detailCanBuild["spec"],[$spec->id => $specOption->id]),
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
                        "spec" => [
                            $spec->id => $specOption->id,
                        ],
                    ];
                }
            }
            $detailCanBuilds = $temp;
        }
        //過濾掉已經建檔SKU
        foreach ($detailCanBuilds as $key => $value){
            if(in_array($value["sku"],$skuExclude)){
                unset($detailCanBuilds[$key]);
            }
        }
        //轉字串
        foreach ($detailCanBuilds as $key => $value){
            $detailCanBuilds[$key]["spec"] = json_encode($value["spec"]??[]);
        }
        //
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
        foreach ($this->details as $item){
            $goodsDetail = GoodsDetail::with(["specs","specOptions"])->find($item["id"]);
            $goodsDetail->name = $item["name"];
            $goodsDetail->sku = $item["sku"];
            $goodsDetail->price = $item["price"];
            $goodsDetail->status = $item["status"];
            $goodsDetail->sort = $item["sort"];
            $goodsDetail->save();
        }
    }

    public function createDetail($key)
    {
        if (empty($this->detailCanBuilds[$key]["sku"])) return;
        //
        $detail = GoodsDetail::where("sku", $this->detailCanBuilds[$key]["sku"])->firstOrNew();
        $detail->sku = $this->detailCanBuilds[$key]["sku"];
        $detail->name = $this->detailCanBuilds[$key]["name"];
        $detail->price = $this->detailCanBuilds[$key]["price"];
        $detail->status = $this->detailCanBuilds[$key]["status"];
        $detail->sort = 1;
        $detail->goods_id = $this->goodsId;
        $detail->save();
        //
        $detailSpec = json_decode($this->detailCanBuilds[$key]["spec"]??[],true);
        foreach ($detailSpec as $key => $value){
            $detailSpec[$key] = [
                "spec_option_id" => $value,
            ];
        }
        $detail->specs()->sync($detailSpec);
        //載入商品
        $item = \App\Models\Goods::with([
            "specs.specOptions",
            "goodsDetails.specs",
            "goodsDetails.specOptions",
        ])->find($this->goodsId);
        //重新載入商品明細列表
        $this->details = $this->loadSpecOptions($item->goodsDetails ?? []);
        //重新載入建議新增
        $this->detailCanBuilds = $this->loadDetailCanBuilds($item->specs ?? [], $item?->name, $item?->sku, $item?->price, $item?->status,array_keys($this->details));
    }

    public function render()
    {
        //
        return view('livewire.update-forms.goods', [
            "specOptions" => \App\Models\Spec::get(),
        ]);
    }
}
