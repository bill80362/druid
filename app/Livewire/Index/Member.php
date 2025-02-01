<?php

namespace App\Livewire\Index;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Member extends Component
{
    use WithPagination;

    #[Url]
    public ?string $name = "";
    #[Url]
    public ?string $status = "";
    #[Url]
    public ?string $content = "";
    #[Url]
    public ?string $account = "";
    #[Url]
    public ?string $password = "";
    #[Url]
    public ?string $line_id = "";
    #[Url]
    public ?string $phone = "";
    #[Url]
    public ?string $postal_code = "";
    #[Url]
    public ?string $address = "";
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
        $query = \App\Models\Member::query();
        if ($this->name) {
            $query->where("name", "like", "%" . $this->name . "%");
        }
        if ($this->status) {
            $query->where("status", "like", "%" . $this->status . "%");
        }
        if ($this->account) {
            $query->where("account", "like", "%" . $this->account . "%");
        }
        if ($this->password) {
            $query->where("password", "like", "%" . $this->password . "%");
        }
        if ($this->line_id) {
            $query->where("line_id", "like", "%" . $this->line_id . "%");
        }
        if ($this->phone) {
            $query->where("phone", "like", "%" . $this->phone . "%");
        }
        if ($this->postal_code) {
            $query->where("postal_code", "like", "%" . $this->postal_code . "%");
        }
        if ($this->address) {
            $query->where("address", "like", "%" . $this->address . "%");
        }
        if ($this->sortByColumn) {
            $query->orderBy($this->sortByColumn, $this->sortByDirection);
        }
        $paginator = $query->with(["level"])->withSum('points','point')->paginate();
        //
        return view('livewire.index.member', [
            "paginator" => $paginator,
        ]);
    }
}
