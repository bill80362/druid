<?php

namespace App\Livewire\Index;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Coupon extends Component
{
    use WithPagination;

    #[Url]
    public ?string $name = "";
    #[Url]
    public ?string $status = "";
    #[Url]
    public ?string $coupon_code = "";
    #[Url]
    public ?string $sortByColumn = "";
    public ?string $sortByDirection = "asc";

    public function sortBy($column)
    {
        $this->sortByColumn = $column;
        $this->sortByDirection = $this->sortByDirection == "asc" ? "desc" : "asc";
    }

    public function render()
    {
        //
        $query = \App\Models\Coupon::query();
        if ($this->name) {
            $query->where("name", "like", "%" . $this->name . "%");
        }
        if ($this->status) {
            $query->where("status", "like", "%" . $this->status . "%");
        }
        if ($this->coupon_code) {
            $query->where("coupon_code", "like", "%" . $this->coupon_code . "%");
        }
        if ($this->sortByColumn) {
            $query->orderBy($this->sortByColumn, $this->sortByDirection);
        }
        $paginator = $query->paginate();
        //
        return view('livewire.index.coupon', [
            "paginator" => $paginator,
        ]);
    }
}
