<?php

namespace App\Livewire\Index;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class LegalAttestLetter extends Component
{
    use WithPagination;

    #[Url]
    public ?string $addressee1 = "";
    #[Url]
    public ?string $postal_code1 = "";
    #[Url]
    public ?string $postal_address1 = "";
    #[Url]
    public ?string $addressee2 = "";
    #[Url]
    public ?string $postal_code2 = "";
    #[Url]
    public ?string $postal_address2 = "";
    #[Url]
    public ?string $sender = "";
    #[Url]
    public ?string $sender_postal_code = "";
    #[Url]
    public ?string $sender_postal_address = "";
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
        $query = \App\Models\LegalAttestLetter::query();
        //
        foreach ([
                     "addressee1",
                     "postal_code1",
                     "postal_address1",
                     "addressee2",
                     "postal_code2",
                     "postal_address2",
                     "sender",
                     "sender_postal_code",
                     "sender_postal_address",
                     "content",
                 ] as $column){
            if ($this->$column) {
                $query->where($column, "like", "%" . $this->$column . "%");
            }
        }

        //
        if ($this->sortByColumn) {
            $query->orderBy($this->sortByColumn, $this->sortByDirection);
        }
        $paginator = $query->paginate();
        //
        return view('livewire.index.legal_attest_letter', [
            "paginator" => $paginator,
        ]);
    }
}
