<?php

namespace App\Livewire\Checkout;

use App\Models\ShoppingCart;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Coupon extends Component
{
    use WithPagination;

    #[Url]
    public ?string $name = "";
    #[Url]
    public ?string $coupon_code = "";
    #[Url]
    public ?string $status = "";
    #[Url]
    public ?string $sortByColumn = "";
    public ?string $sortByDirection = "asc";
    //
    public mixed $member_id = "";

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
        //member_id
        $shoppingCard = ShoppingCart::where("user_id", auth()->user()->id)->firstOrNew();
        $this->member_id = $shoppingCard->data["member_id"]??"";
        //
        $query = \App\Models\Coupon::query();
        if ($this->name) {
            $query->where("name", "like", "%" . $this->name . "%");
        }
        if ($this->coupon_code) {
            $query->where("coupon_code", "like", "%" . $this->coupon_code . "%");
        }
        if ($this->status) {
            $query->where("status", $this->status);
        }
        if ($this->sortByColumn) {
            $query->orderBy($this->sortByColumn, $this->sortByDirection);
        }
        $paginator = $query
            ->with(["orders"])
            ->paginate();
        //
        return view('livewire.checkout.coupon', [
            "paginator" => $paginator,
        ]);
    }
}
