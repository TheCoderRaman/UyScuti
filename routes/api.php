<?php

use Illuminate\Support\Facades\Route;

// Api version v1 controllers
use App\Http\Controllers\Api\V1\Auth\AuthController;

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
            (Route::post('/login', [
                AuthController::class, 'login'])->name('v1#api.auth.login')
            );
            (Route::post('/logout', [
                AuthController::class, 'logout'])->name('v1#api.auth.logout')
            );
            (Route::post('/update', [
                AuthController::class, 'update'])->name('v1#api.auth.update')
            );
            (Route::get('/profile', [
                AuthController::class, 'profile'])->name('v1#api.auth.profile')
            );
            (Route::post('/refresh', [
                AuthController::class, 'refresh'])->name('v1#api.auth.refresh')
            );
            (Route::post('/register', [
                AuthController::class, 'register'])->name('v1#api.auth.register')
            );
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

        /**
         * All routes related to contact.
         *
         * @method GET|POST|PUT|PATCH|HEAD|DELETE|OPTIONS
         * @see http://domain.tld/api/v1/contact
         */
        Route::prefix('contact')->group(function () {
            //
        });

        /**
         * All routes related to newsletter.
         *
         * @method GET|POST|PUT|PATCH|HEAD|DELETE|OPTIONS
         * @see http://domain.tld/api/v1/newsletter
         */
        Route::prefix('newsletter')->group(function () {
            //
        });

        /**
         * All routes related to uyscuti search engine.
         *
         * @method POST
         * @see http://domain.tld/api/v1/search
         */
        Route::prefix('search')->group(function () {
            //
        });
    });
});