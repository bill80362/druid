<?php

namespace App\Livewire\UpdateForms;

use App\Models\PermissionGroup;
use Livewire\Component;

class User extends Component
{
    public $userId = null;

    public $name = "";
    public $email = "";
    public $password = "";
    public $permissionIdArray = [];
    //
    public $actionMessage = "";

    public function mount($id)
    {
        $this->userId = $id;
    }

    public function submit()
    {
        $item = \App\Models\User::with(["permissions"])->find($this->userId);
        $item->name = $this->name;
        $item->email = $this->email;
        if($this->password){
            $item->password = $this->password;
        }
        $item->save();
        //
        $item->permissions()->sync($this->permissionIdArray);
        //
        $this->actionMessage = "儲存成功";
    }

    public function render()
    {
        //
        $item = \App\Models\User::with(["permissions"])->find($this->userId);
        //
        $this->name = $item->name;
        $this->email = $item->email;
        $this->permissionIdArray = $item->permissions->pluck("id")->toArray();
        //
        return view('livewire.update-forms.user', [
            "item" => $item,
            "permissionGroups" => PermissionGroup::with(["permissions"])->get()
        ]);
    }
}
