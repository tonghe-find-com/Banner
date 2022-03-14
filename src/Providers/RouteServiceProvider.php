<?php

namespace TypiCMS\Modules\Banners\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Banners\Http\Controllers\AdminController;
use TypiCMS\Modules\Banners\Http\Controllers\ApiController;
use TypiCMS\Modules\Banners\Http\Controllers\PublicController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('banners', [AdminController::class, 'index'])->name('index-banners')->middleware('can:read banners');
            $router->get('banners/export', [AdminController::class, 'export'])->name('admin::export-banners')->middleware('can:read banners');
            $router->get('banners/create', [AdminController::class, 'create'])->name('create-banner')->middleware('can:create banners');
            $router->get('banners/{banner}/edit', [AdminController::class, 'edit'])->name('edit-banner')->middleware('can:read banners');
            $router->post('banners', [AdminController::class, 'store'])->name('store-banner')->middleware('can:create banners');
            $router->put('banners/{banner}', [AdminController::class, 'update'])->name('update-banner')->middleware('can:update banners');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('banners', [ApiController::class, 'index'])->middleware('can:read banners');
            $router->patch('banners/{banner}', [ApiController::class, 'updatePartial'])->middleware('can:update banners');
            $router->delete('banners/{banner}', [ApiController::class, 'destroy'])->middleware('can:delete banners');
        });
    }
}
