<?php

namespace App\Livewire\Index;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Goods extends Component
{
    use WithPagination;

    #[Url]
    public ?string $name = "";
    #[Url]
    public ?string $sku = "";
    #[Url]
    public ?string $status = "";
    #[Url]
    public ?string $sortByColumn = "";
    public ?string $sortByDirection = "asc";
    //
    public array $statusText = [
        "Y" => "顯示",
        "N" => "隱藏",
    ];

    public function sortBy($column)
    {
        $this->sortByColumn = $column;
        $this->sortByDirection = $this->sortByDirection == "asc" ? "desc" : "asc";
    }

    public function render()
    {
        //
        $query = \App\Models\Goods::query();
        if ($this->name) {
            $query->where("name", "like", "%" . $this->name . "%");
        }
        if ($this->sku) {
            $query->where("sku", "like", "%" . $this->sku . "%");
        }
        if ($this->status) {
            $query->where("status", $this->status);
        }
        if ($this->sortByColumn) {
            $query->orderBy($this->sortByColumn, $this->sortByDirection);
        }
        $paginator = $query->paginate();
        //
        return view('livewire.index.goods', [
            "paginator" => $paginator,
            "specOptions" => \App\Models\Spec::get(),
        ]);
    }
}
