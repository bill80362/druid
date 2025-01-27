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
            "title" => __("使用說明書"),
            "href" => route('dashboard'),
            "active" => request()->routeIs('dashboard'),
            "submenus" => [],
        ]);
        //
        $menus->push([
            "title" => __("商品管理"),
            "href" => "#",
            "active" => "",
            "submenus" => [
                [
                    "title" => __("主商品管理"),
                    "href" => route('goods.index'),
                    "active" => request()->routeIs('goods.index'),
                ],
                [
                    "title" => __("商品明細管理"),
                    "href" => route('goods_details.index'),
                    "active" => request()->routeIs('goods_details.index'),
                ],
            ],
        ]);
        //
        $menus->push([
            "title" => __("訂單管理"),
            "href" => "#",
            "active" => "",
            "submenus" => [
                [
                    "title" => __("訂單管理"),
                    "href" => route('orders.index'),
                    "active" => request()->routeIs('orders.index'),
                ],
            ],
        ]);
        //
        $menus->push([
            "title" => __("會員管理"),
            "href" => "#",
            "active" => "",
            "submenus" => [
                [
                    "title" => __("會員管理"),
                    "href" => route('members.index'),
                    "active" => request()->routeIs('members.index'),
                ],
                [
                    "title" => __("LINE對話紀錄"),
                    "href" => route('line_messages.index'),
                    "active" => request()->routeIs('line_messages.index'),
                ],
                [
                    "title" => __("Meta對話紀錄"),
                    "href" => route('meta_messages.index'),
                    "active" => request()->routeIs('meta_messages.index'),
                ],
            ],
        ]);
        //
        $menus->push([
            "title" => __("門市管理"),
            "href" => "#",
            "active" => "",
            "submenus" => [
                [
                    "title" => __("收銀台結帳1"),
                    "href" => route('checkout.checkout'),
                    "active" => request()->routeIs('checkout.checkout'),
                ],
            ],
        ]);
        //
//        $menus->push([
//            "title" => __("存證信函管理"),
//            "href" => "#",
//            "active" => "",
//            "submenus" => [
//                [
//                    "title" => __("存證信函"),
//                    "href" => route('legal_attest_letters.index'),
//                    "active" => request()->routeIs('legal_attest_letters.index'),
//                ],
//                [
//                    "title" => __("存證信函寄送"),
//                    "href" => route('page_tags.index'),
//                    "active" => request()->routeIs('page_tags.index'),
//                ],
//            ],
//        ]);
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
            "title" => __("批次管理"),
            "href" => route('users.index'),
            "active" => "",
            "submenus" => [
                [
                    "title" => __("商品匯出"),
                    "href" => route('excel.export'),
                    "active" => false,
                ],
                [
                    "title" => __("商品匯入"),
                    "href" => route('excel.import'),
                    "active" => false,
                ],
            ],
        ]);
        //
        $menus->push([
            "title" => __("系統設定"),
            "href" => route('users.index'),
            "active" => "",
            "submenus" => [
//                [
//                    "title" => __("頁面管理"),
//                    "href" => route('pages.index'),
//                    "active" => request()->routeIs('pages.index'),
//                ],
//                [
//                    "title" => __("頁面標籤管理"),
//                    "href" => route('page_tags.index'),
//                    "active" => request()->routeIs('page_tags.index'),
//                ],
                [
                    "title" => __("帳號管理"),
                    "href" => route('users.index'),
                    "active" => request()->routeIs('users.index'),
                ],
//                [
//                    "title" => __("自訂欄位管理"),
//                    "href" => route('users.index'),
//                    "active" => request()->routeIs('users.index'),
//                ],

                [
                    "title" => __("規格群組管理"),
                    "href" => route('specs.index'),
                    "active" => request()->routeIs('specs.index'),
                ],
                [
                    "title" => __("規格選項管理"),
                    "href" => route('spec_options.index'),
                    "active" => request()->routeIs('spec_options.index'),
                ],
                [
                    "title" => __("LINE帳號管理"),
                    "href" => route('lines.index'),
                    "active" => request()->routeIs('lines.index'),
                ],
                [
                    "title" => __("Meta串接管理"),
                    "href" => route('metas.index'),
                    "active" => request()->routeIs('metas.index'),
                ],
                [
                    "title" => __("付款方式管理"),
                    "href" => route('payments.index'),
                    "active" => request()->routeIs('payments.index'),
                ],
                [
                    "title" => __("等級管理"),
                    "href" => route('levels.index'),
                    "active" => request()->routeIs('levels.index'),
                ],
            ],
        ]);
        //
        $menus->push([
            "title" => __("登入")."(".auth()->user()?->name.")",
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
