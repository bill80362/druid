<?php

namespace App\Livewire\Index;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Order extends Component
{
    use WithPagination;

    #[Url]
    public ?string $name = "";
    #[Url]
    public ?string $status = "";
    #[Url]
    public ?string $sortByColumn = "id";
    public ?string $sortByDirection = "desc";

    public function sortBy($column)
    {
        $this->sortByColumn = $column;
        $this->sortByDirection = $this->sortByDirection == "asc" ? "desc" : "asc";
    }

    public function render()
    {
        //
        $query = \App\Models\Order::user();
        if ($this->name) {
            $query->where("name", "like", "%" . $this->name . "%");
        }
        if ($this->status) {
            $query->where("status", "like", "%" . $this->status . "%");
        }
        if ($this->sortByColumn) {
            $query->orderBy($this->sortByColumn, $this->sortByDirection);
        }
        $paginator = $query->with(["member.level","orderDetails","orderPayments.payment"])->paginate();
        //
        return view('livewire.index.order', [
            "paginator" => $paginator,
        ]);
    }
}
