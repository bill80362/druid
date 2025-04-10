<?php

namespace App\Livewire\Index;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MetaMessages extends Component
{
    use WithPagination;

    #[Url]
    public ?string $message = "";
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
        $query = \App\Models\MetaMessage::user();
        if ($this->message) {
            $query->where("message", "like", "%" . $this->message . "%");
        }
        if ($this->sortByColumn) {
            $query->orderBy($this->sortByColumn, $this->sortByDirection);
        }
        $paginator = $query->paginate();
        //
        return view('livewire.index.meta_messages', [
            "paginator" => $paginator,
        ]);
    }
}
