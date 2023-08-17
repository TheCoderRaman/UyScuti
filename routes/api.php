<?php

use Illuminate\Support\Facades\Route;

// Api version v1 controllers
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Bot\CrawlerController;
use App\Http\Controllers\Api\V1\Search\LabelController;
use App\Http\Controllers\Api\V1\Search\ResultController;
use App\Http\Controllers\Api\V1\Contact\TicketController;
use App\Http\Controllers\Api\V1\Search\RedirectController;
use App\Http\Controllers\Api\V1\Search\SuggestionController;
use App\Http\Controllers\Api\V1\NewsLetter\SubscriberController;

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
            (Route::post('/crawl', [
                CrawlerController::class, 'crawl'])->name('v1#api.bot.crawl')
            );
        });

        /**
         * All routes related to contact.
         *
         * @method GET|POST|PUT|PATCH|HEAD|DELETE|OPTIONS
         * @see http://domain.tld/api/v1/contact
         */
        Route::prefix('contact')->group(function () {
            Route::resource('/ticket', TicketController::class,[
                'as' => 'v1#api'
            ]);
        });

        /**
         * All routes related to newsletter.
         *
         * @method GET|POST|PUT|PATCH|HEAD|DELETE|OPTIONS
         * @see http://domain.tld/api/v1/newsletter
         */
        Route::prefix('newsletter')->group(function () {
            Route::resource('/subscriber', SubscriberController::class,[
                'as' => 'v1#api'
            ]);
        });

        /**
         * All routes related to uyscuti search engine.
         *
         * @method POST
         * @see http://domain.tld/api/v1/search
         */
        Route::prefix('search')->group(function () {
            (Route::post('/label', [
                LabelController::class, 'label'])->name('v1#api.search.label')
            );
            (Route::post('/result', [
                ResultController::class, 'result'])->name('v1#api.search.result')
            );
            (Route::get('/redirect', [
                RedirectController::class, 'redirect'])->name('v1#api.search.redirect')
            );
            (Route::post('/suggest', [
                SuggestionController::class, 'suggest'])->name('v1#api.search.suggest')
            );
        });
    });
});