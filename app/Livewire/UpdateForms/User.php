<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Attributes\Validate;
use Livewire\Component;

class User extends Component
{
    public $userId = null;

    #[Validate(['required','min:4','max:20'], as: '名稱')]
    public string $name = "";
    #[Validate(['required'], as: 'Email')]
    public string $email = "";
    #[Validate([], as: '密碼')]
    public string $password = "";

    public array $permissionIdArray = [];
    //
    public string $actionMessage = "";

    public function mount($id)
    {
        $this->userId = $id;
        //
        $item = \App\Models\User::with(["permissions"])->find($this->userId);
        $this->name = $item?->name ?? "";
        $this->email = $item?->email ?? "";
        $this->permissionIdArray = $item?->permissions->pluck("id")->toArray() ?? [];
    }

    public function submit()
    {
        //
        $this->actionMessage = "";
        //
        if(!$this->userId){
            $this->validate([
                "name" => ["required"],
                "email" => ["required"],
                "password" => ["required"],
            ]);
        }else{
            $this->validate();
        }
        //
        $item = \App\Models\User::with(["permissions"])->findOrNew($this->userId);
        $item->name = $this->name;
        $item->email = $this->email;
        if ($this->password) {
            $item->password = $this->password;
        }
        $item->save();
        //
        $item->permissions()->sync($this->permissionIdArray);
        //
        if ($this->userId) {
            $this->actionMessage = "更新成功";
        } else {
            $this->actionMessage = "新增成功";
            return redirect()->route('users.edit', ["user" => $item]);
        }
//        return redirect()->route('users.edit', ["user" => $item])->with("success", ["新增成功"]);

    }

    public function render()
    {
        return view('livewire.update-forms.user', [
            "permissionGroups" => PermissionGroup::with(["permissions"])->get()
        ]);
    }
}
