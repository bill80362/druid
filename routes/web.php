<?php

use Illuminate\Support\Facades\Route;

//首頁
Route::view('/', 'welcome');

//webhook
Route::get('webhooks', [\App\Http\Controllers\Api\WebhookFbController::class, "verify"]);
Route::post('webhooks', [\App\Http\Controllers\Api\WebhookFbController::class, "webhook"]);

//靜態
Route::view('info/privacy', 'info/privacy');
Route::view('info/service', 'info/service');
Route::view('info/remove', 'info/remove');

//line_liff
Route::view('line_liff/login', 'line_liff/login');
Route::get('line_liff/profile', [\App\Http\Controllers\LineLiffController::class, 'profile'])->name("settings.edit");
Route::post('line_liff/register', [\App\Http\Controllers\LineLiffController::class, 'register'])->name("settings.edit");

//會員登入模擬
Route::get('member/{id}', [\App\Http\Controllers\Front\MemberController::class, "member"]);

//
Route::get('login', [\App\Http\Controllers\LoginController::class, "login"])->name("login");
Route::post('login', [\App\Http\Controllers\LoginController::class, "loginAction"]);


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

/**開發期間 */
Route::middleware(['auth'])->group(function (){
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('pages', \App\Http\Controllers\PageController::class);
    Route::resource('page_tags', \App\Http\Controllers\PageTagController::class);
    Route::resource('goods', \App\Http\Controllers\GoodsController::class)->parameters([
        "goods" => "goods:id",
    ]);
    Route::resource('specs', \App\Http\Controllers\SpecController::class);
    Route::resource('spec_options', \App\Http\Controllers\SpecOptionController::class);
    Route::resource('goods_details', \App\Http\Controllers\GoodsDetailController::class);
    Route::resource('legal_attest_letters', \App\Http\Controllers\LegalAttestLetterController::class);
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
    Route::resource('members', \App\Http\Controllers\MemberController::class);
    Route::resource('lines', \App\Http\Controllers\LineController::class);
    Route::resource('line_messages', \App\Http\Controllers\LineMessagesController::class);
    Route::resource('metas', \App\Http\Controllers\MetaController::class);
    Route::resource('meta_messages', \App\Http\Controllers\MetaMessagesController::class);
    Route::resource('payments', \App\Http\Controllers\PaymentController::class);
    Route::resource('levels', \App\Http\Controllers\LevelController::class);
    Route::resource('discounts', \App\Http\Controllers\DiscountController::class);
    Route::resource('points', \App\Http\Controllers\PointController::class);
    Route::resource('replies', \App\Http\Controllers\ReplyController::class);
    Route::resource('coupons', \App\Http\Controllers\CouponController::class);
//    Route::resource('settings', \App\Http\Controllers\SettingController::class)->only(["edit","update"]);

    Route::post('members/{id}/point/add', [\App\Http\Controllers\MemberController::class, 'pointAdd'])->name("members.point.add");
    Route::post('members/{id}/point/minus', [\App\Http\Controllers\MemberController::class, 'pointMinus'])->name("members.point.minus");


    Route::resource('bind/line/members', \App\Http\Controllers\BindLineMemberController::class)->only(["index","update"])->names("bind_line_members");

    Route::get('settings/{setting}/edit', [\App\Http\Controllers\SettingController::class, 'edit'])->name("settings.edit");
    Route::post('settings/{setting}/update', [\App\Http\Controllers\SettingController::class, 'update'])->name("settings.update");


    Route::get('goods/edit2/{goods}', [\App\Http\Controllers\GoodsController::class, 'edit2'])->name("goods.edit2");
    Route::post('goods/update2/{goods}', [\App\Http\Controllers\GoodsController::class, 'update2'])->name("goods.update2");

    Route::post('web/editor', [\App\Http\Controllers\WebEditorController::class, 'upload'])->name("web.editor.upload");

    Route::get('excel/output', [\App\Http\Controllers\ExcelController::class, 'export'])->name("excel.export");
    Route::get('excel/import', [\App\Http\Controllers\ExcelController::class, 'import'])->name("excel.import");
    Route::post('excel/import', [\App\Http\Controllers\ExcelController::class, 'importAction'])->name("excel.import.action");

    Route::get('checkout/checkout', [\App\Http\Controllers\CheckoutController::class, 'checkout'])->name("checkout.checkout");
    Route::post('checkout/checkout', [\App\Http\Controllers\CheckoutController::class, 'finish'])->name("checkout.finish");
    Route::get('checkout/add/goods', [\App\Http\Controllers\CheckoutController::class, 'addGoods'])->name("checkout.add.goods");
    Route::get('checkout/remove/goods', [\App\Http\Controllers\CheckoutController::class, 'removeGoods'])->name("checkout.remove.goods");
    Route::get('checkout/remove/coupon', [\App\Http\Controllers\CheckoutController::class, 'removeCoupon'])->name("checkout.remove.coupon");
//    Route::get('checkout/set/member', [\App\Http\Controllers\CheckoutController::class, 'setMember'])->name("checkout.set.member");
    Route::get('checkout/reset/member', [\App\Http\Controllers\CheckoutController::class, 'resetMember'])->name("checkout.reset.member");
    Route::get('checkout/add/payment', [\App\Http\Controllers\CheckoutController::class, 'addPayment'])->name("checkout.add.payment");
    Route::get('checkout/remove/payment', [\App\Http\Controllers\CheckoutController::class, 'removePayment'])->name("checkout.remove.payment");
    Route::post('checkout/use/point', [\App\Http\Controllers\CheckoutController::class, 'usePoint'])->name("checkout.use.point");

    Route::get('goods_detail/batch', [\App\Http\Controllers\GoodsDetailBatchController::class, 'index'])->name("goods_details.batch.index");
    Route::post('goods_detail/batch', [\App\Http\Controllers\GoodsDetailBatchController::class, 'update'])->name("goods_details.batch.update");


});


