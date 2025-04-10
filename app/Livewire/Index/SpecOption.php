<?php

namespace App\Livewire\Index;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SpecOption extends Component
{
    use WithPagination;

    #[Url]
    public ?string $name = "";
    #[Url]
    public ?string $sku = "";
    #[Url]
    public ?string $content = "";
    #[Url]
    public ?string $spec_id = "";
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
        $query = \App\Models\SpecOption::user();
        if ($this->name) {
            $query->where("name", "like", "%" . $this->name . "%");
        }
        if ($this->sku) {
            $query->where("sku", "like", "%" . $this->sku . "%");
        }
        if ($this->content) {
            $query->where("content", "like", "%" . $this->content . "%");
        }
        if ($this->spec_id) {
            $query->where("spec_id", $this->spec_id );
        }
        if ($this->sortByColumn) {
            $query->orderBy($this->sortByColumn, $this->sortByDirection);
        }
        $paginator = $query->paginate();
        //
        return view('livewire.index.spec_option', [
            "paginator" => $paginator,
            "specOptions" => \App\Models\Spec::get(),
        ]);
    }
}
