<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\EbookController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\MainMenuController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ReporterController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Frontend\FrontendHomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect('/login');
// });
Route::get('/', [FrontendHomeController::class, 'index'])->name('home-page');
Route::get('/top-news', [FrontendHomeController::class, 'index'])->name('home-page');


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        // Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        #Banner Menu
        Route::get('home-banner', [HomeBannerController::class, 'index'])->name('home-banner');
        Route::get('home-banner-form', [HomeBannerController::class, 'bannerForm'])->name('home-banner-form');
        Route::post('home-banner-store', [HomeBannerController::class, 'store'])->name('home-banner-store');
        Route::get('home-banner-edit/{id}', [HomeBannerController::class, 'edit'])->name('home-banner-edit');
        Route::post('home-banner-status', [HomeBannerController::class, 'toggleStatus'])->name('home-banner-status');
        Route::post('home-banner-update', [HomeBannerController::class, 'update'])->name('home-banner-update');
        Route::post('home-banner-delete', [HomeBannerController::class, 'delete'])->name('home-banner-delete');

        #Main Menu
        Route::get('main-menu', [MainMenuController::class, 'index'])->name('main-menu');
        Route::get('main-menu-form', [MainMenuController::class, 'mainMenuForm'])->name('main-menu-form');
        Route::post('main-menu-store', [MainMenuController::class, 'store'])->name('main-menu-store');
        Route::get('main-menu-edit/{id}', [MainMenuController::class, 'edit'])->name('main-menu-edit');
        Route::post('main-menu-status', [MainMenuController::class, 'toggleStatus'])->name('main-menu-status');
        Route::post('main-menu-update', [MainMenuController::class, 'update'])->name('main-menu-update');
        Route::post('main-menu-delete', [MainMenuController::class, 'delete'])->name('main-menu-delete');
        Route::post('main-menu-sortable', [MainMenuController::class, 'sortable'])->name('main-menu-sortable');


        #States Menu
        Route::get('states', [StateController::class, 'index'])->name('states');
        Route::get('states-form', [StateController::class, 'stateForm'])->name('states-form');
        Route::post('check-state', [StateController::class, 'checkState'])->name('check-state');
        Route::post('states-store', [StateController::class, 'store'])->name('states-store');
        Route::get('states-edit/{id}', [StateController::class, 'edit'])->name('states-edit');
        Route::post('states-status', [StateController::class, 'toggleStatus'])->name('states-status');
        Route::post('states-update', [StateController::class, 'update'])->name('states-update');
        Route::post('states-delete', [StateController::class, 'delete'])->name('states-delete');

        #City Menu
        Route::get('cities', [CityController::class, 'index'])->name('cities');
        Route::get('cities-form', [CityController::class, 'cityForm'])->name('cities-form');
        Route::get('get-states', [CityController::class, 'getStates'])->name('get-states');
        Route::post('check-city', [CityController::class, 'checkCity'])->name('check-city');
        Route::post('cities-store', [CityController::class, 'store'])->name('cities-store');
        Route::get('cities-edit/{id}', [CityController::class, 'edit'])->name('cities-edit');
        Route::post('cities-status', [CityController::class, 'toggleStatus'])->name('cities-status');
        Route::post('cities-update', [CityController::class, 'update'])->name('cities-update');
        Route::post('cities-delete', [CityController::class, 'delete'])->name('cities-delete');


        #Reporters
        Route::get('reporters', [ReporterController::class, 'index'])->name('reporters');
        Route::get('reporters-form', [ReporterController::class, 'reporterForm'])->name('reporters-form');
        Route::get('reporters-get-city', [ReporterController::class, 'getCity'])->name('reporters-get-city');
        Route::post('reporters-store', [ReporterController::class, 'store'])->name('reporters-store');
        Route::get('reporters-edit/{id}', [ReporterController::class, 'edit'])->name('reporters-edit');
        Route::post('reporters-update', [ReporterController::class, 'update'])->name('reporters-update');
        Route::post('reporters-status', [ReporterController::class, 'toggleStatus'])->name('reporters-status');
        Route::post('reporters-delete', [ReporterController::class, 'delete'])->name('reporters-delete');

        #News Details
        Route::get('news', [NewsController::class, 'index'])->name('news');
        Route::get('news-form', [NewsController::class, 'newsForm'])->name('news-form');
        Route::get('news-link', [NewsController::class, 'getnewsLinks'])->name('news-link');
        Route::get('news-get-city', [NewsController::class, 'getCity'])->name('news-get-city');
        Route::post('news-store', [NewsController::class, 'store'])->name('news-store');
        Route::get('news-edit/{id}', [NewsController::class, 'edit'])->name('news-edit');
        Route::post('news-update', [NewsController::class, 'update'])->name('news-update');
        Route::post('news-status', [NewsController::class, 'toggleStatus'])->name('news-status');
        Route::post('news-delete', [NewsController::class, 'delete'])->name('news-delete');

        #Ebooks Menu
        Route::get('ebooks', [EbookController::class, 'index'])->name('ebooks');
        Route::get('ebooks-form', [EbookController::class, 'ebookForm'])->name('ebooks-form');
        Route::post('ebooks-store', [EbookController::class, 'store'])->name('ebooks-store');
        Route::get('ebooks-edit/{id}', [EbookController::class, 'edit'])->name('ebooks-edit');
        Route::post('ebooks-status', [EbookController::class, 'toggleStatus'])->name('ebooks-status');
        Route::post('ebooks-update', [EbookController::class, 'update'])->name('ebooks-update');
        Route::post('ebooks-delete', [EbookController::class, 'delete'])->name('ebooks-delete');
    });
});

// Reporter route
require __DIR__ . '/reporter.php';

//Dynamic route
Route::get('/{slug}', [FrontendHomeController::class, 'index'])->name('category-wise-news');
Route::get('/{city}/{slug}', [FrontendHomeController::class, 'categoryDetailNews'])->name('category-detail-news');
