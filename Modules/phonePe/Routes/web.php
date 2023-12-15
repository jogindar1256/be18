<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\PhonePe\Http\Controllers\PhonePeController;


Route::prefix('gateway/phonepe')->group(function () {
    // Define routes for PhonePe payment processing
    Route::post('/initialize', [PhonePeController::class, 'initializeTransaction'])->name('phonepe.initialize');
    Route::get('/callback', [PhonePeController::class, 'handleCallback'])->name('phonepe.callback');
    Route::get('/status/{transactionId}', [PhonePeController::class, 'checkTransactionStatus'])->name('phonepe.status');
    Route::post('/refund', [PhonePeController::class, 'initiateRefund'])->name('phonepe.refund');
    Route::get('/refund/status/{refundId}', [PhonePeController::class, 'checkRefundStatus'])->name('phonepe.refund.status');
});

// PhonePe payment page
Route::get('phonepe', 'PhonePeController@phonePe')->name('phonepe.payment');

// Handle PhonePe payment response
Route::post('phonepe-response', 'PhonePeController@response')->name('phonepe.response');
