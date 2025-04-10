<?php

namespace App\Livewire\Index;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Reply extends Component
{
    use WithPagination;

    #[Url]
    public ?string $name = "";
    #[Url]
    public ?string $content = "";
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
        $query = \App\Models\Reply::user();
        if ($this->name) {
            $query->where("name", "like", "%" . $this->name . "%");
        }
        if ($this->content) {
            $query->where("content", "like", "%" . $this->content . "%");
        }
        if ($this->sortByColumn) {
            $query->orderBy($this->sortByColumn, $this->sortByDirection);
        }
        $paginator = $query->paginate();
        //
        return view('livewire.index.reply', [
            "paginator" => $paginator,
        ]);
    }
}
