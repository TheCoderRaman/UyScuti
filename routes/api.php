<?php

use Illuminate\Support\Facades\Route;

// Api version v1 controllers

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware(['api','throttle:60,1'])->group(function () {
    /**
     * All api routes for version: v1
     *
     * @method GET|POST
     * @see http://domain.tld/api/v1
     */
    Route::prefix('v1')->group(function () {
        /**
         * All routes related to authentication.
         *
         * @method GET|POST
         * @see http://domain.tld/api/v1/auth
         */
        Route::prefix('auth')->group(function () {
            //
        });

        /**
         * All routes related to uyscuti bot.
         *
         * @method POST
         * @see http://domain.tld/api/v1/bot
         */
        Route::prefix('bot')->group(function () {
            //
        });
    });
});