<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * 選單
     */
    public function menus(): \Illuminate\Support\Collection
    {
        $menus = collect();
        //
        $menus->push([
            "title" => __("首頁"),
            "href" => route('dashboard'),
            "active" => request()->routeIs('dashboard'),
            "submenus" => [],
        ]);
        //
        $menus->push([
            "title" => __("內容管理系統"),
            "href" => route('users.index'),
            "active" => "",
            "submenus" => [
                [
                    "title" => __("頁面管理"),
                    "href" => route('pages.index'),
                    "active" => request()->routeIs('pages.index'),
                ],
                [
                    "title" => __("頁面標籤管理"),
                    "href" => route('page_tags.index'),
                    "active" => request()->routeIs('page_tags.index'),
                ],
            ],
        ]);
        //
        return $menus;
    }
    /**
     * 選單
     */
    public function rightMenus(): \Illuminate\Support\Collection
    {
        $menus = collect();
        //
        $menus->push([
            "title" => __("系統設定"),
            "href" => route('users.index'),
            "active" => "",
            "submenus" => [
                [
                    "title" => __("帳號管理"),
                    "href" => route('users.index'),
                    "active" => request()->routeIs('users.index'),
                ],
                [
                    "title" => __("自訂欄位管理"),
                    "href" => route('users.index'),
                    "active" => request()->routeIs('users.index'),
                ],
            ],
        ]);
        //
        $menus->push([
            "title" => __("我的個人資料")."(".auth()->user()->name.")",
            "href" => route('profile'),
            "active" => request()->routeIs('profile'),
            "submenus" => [],
        ]);
        //
        return $menus;
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
};
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{config("app.name")}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach($this->menus() as $menu)
                    <li class="nav-item dropdown">
                        <a class="nav-link active @if(!empty($menu["submenus"]))  dropdown-toggle @endif"
                           role="button"
                           href="{{$menu["href"]}}" id="{{ $menu["title"]  }}"
                           @if(!empty($menu["submenus"])) data-bs-toggle="dropdown" aria-expanded="false" @endif
                        >{{ $menu["title"]  }}</a>
                        <ul class="dropdown-menu" aria-labelledby="{{ $menu["title"]  }}">
                            @foreach($menu["submenus"] as $submenu)
                                <li><a class="dropdown-item" href="{{$submenu["href"]}}">{{$submenu["title"]}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach($this->rightMenus() as $menu)
                    <li class="nav-item dropdown">
                        <a class="nav-link active @if(!empty($menu["submenus"]))  dropdown-toggle @endif"
                           role="button"
                           href="{{$menu["href"]}}" id="{{ $menu["title"]  }}"
                           @if(!empty($menu["submenus"])) data-bs-toggle="dropdown" aria-expanded="false" @endif
                        >{{ $menu["title"]  }}</a>
                        <ul class="dropdown-menu" aria-labelledby="{{ $menu["title"]  }}">
                            @foreach($menu["submenus"] as $submenu)
                                <li><a class="dropdown-item" href="{{$submenu["href"]}}">{{$submenu["title"]}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                    <li class="nav-item dropdown">
                        <a wire:click="logout" class="nav-link">{{__("Logout")}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
