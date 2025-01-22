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

//會員登入模擬
Route::get('member/{id}', [\App\Http\Controllers\Front\MemberController::class, "member"]);


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

    Route::get('goods/edit2/{goods}', [\App\Http\Controllers\GoodsController::class, 'edit2'])->name("goods.edit2");
    Route::post('goods/update2/{goods}', [\App\Http\Controllers\GoodsController::class, 'update2'])->name("goods.update2");

    Route::post('web/editor', [\App\Http\Controllers\WebEditorController::class, 'upload'])->name("web.editor.upload");

    Route::get('excel/output', [\App\Http\Controllers\ExcelController::class, 'export'])->name("excel.export");
    Route::get('excel/import', [\App\Http\Controllers\ExcelController::class, 'import'])->name("excel.import");
    Route::post('excel/import', [\App\Http\Controllers\ExcelController::class, 'importAction'])->name("excel.import.action");

    Route::get('checkout/checkout', [\App\Http\Controllers\CheckoutController::class, 'checkout'])->name("checkout.checkout");


});


