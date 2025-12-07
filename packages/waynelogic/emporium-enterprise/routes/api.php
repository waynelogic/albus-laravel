<?php

use Illuminate\Support\Facades\Route;
use Waynelogic\EmporiumEnterprise\Http\Controllers\ExchangeController;
use Illuminate\Session\Middleware\StartSession;

Route::group([
    'prefix' => 'api',
    'middleware' => ['auth.basic:admin', StartSession::class],
], function () {
    Route::match(['get', 'post'], '1c_exchange', ExchangeController::class)->name('1c_exchange');
});
