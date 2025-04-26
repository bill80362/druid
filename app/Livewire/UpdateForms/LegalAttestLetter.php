<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LegalAttestLetter extends Component
{
    public $legalAttestLetterId = null;

    #[Validate([])]
    public ?string $addressee1 = "";
    #[Validate([])]
    public ?string $postal_code1 = "";
    #[Validate([])]
    public ?string $postal_address1 = "";
    #[Validate([])]
    public ?string $addressee2 = "";
    #[Validate([])]
    public ?string $postal_code2 = "";
    #[Validate([])]
    public ?string $postal_address2 = "";
    #[Validate([])]
    public ?string $sender = "";
    #[Validate([])]
    public ?string $sender_postal_code = "";
    #[Validate([])]
    public ?string $sender_postal_address = "";
    #[Validate([])]
    public ?string $content = "";
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->legalAttestLetterId = $id;
        //
        $item = \App\Models\LegalAttestLetter::find($this->legalAttestLetterId);
//        $this->name = $item?->name ?? "";
//        $this->content = $item?->content ?? "";
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
            $this->$column = $item?->$column ?? "";
        }
    }

    public function submit()
    {
        //
        $this->actionMessage = "";
        //
        $this->validate();
        //
        $item = \App\Models\LegalAttestLetter::findOrNew($this->legalAttestLetterId);
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
            $item->$column = $this->$column;
        }
//        $item->name = $this->name;
//        $item->content = $this->content;
        $item->user_id = auth()->user()->id;
        $item->save();
        //
        if ($this->legalAttestLetterId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('legal_attest_letters.edit', ["legal_attest_letter" => $item]);
        }
    }

    public function render()
    {
        return view('livewire.update-forms.legal_attest_letter');
    }
}
