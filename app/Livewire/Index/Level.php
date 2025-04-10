<?php

namespace App\Livewire\Index;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Level extends Component
{
    use WithPagination;

    #[Url]
    public ?string $name = "";
    #[Url]
    public ?string $sort = "";
    #[Url]
    public ?string $upgrade = "";
    #[Url]
    public ?string $degrade = "";
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
        $query = \App\Models\Level::user();
        if ($this->name) {
            $query->where("name", "like", "%" . $this->name . "%");
        }
        if ($this->sort) {
            $query->where("sort", "like", "%" . $this->sort . "%");
        }
        if ($this->upgrade) {
            $query->where("upgrade", "like", "%" . $this->upgrade . "%");
        }
        if ($this->degrade) {
            $query->where("degrade", "like", "%" . $this->degrade . "%");
        }
        if ($this->sortByColumn) {
            $query->orderBy($this->sortByColumn, $this->sortByDirection);
        }
        $paginator = $query->paginate();
        //
        return view('livewire.index.level', [
            "paginator" => $paginator,
        ]);
    }
}
