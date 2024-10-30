<?php

namespace App\Providers;

use App\Models\PrinterQueue;
use App\Observers\PrintObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        require_once app_path('Helpers/ZplPrinterPrintHelper.php');
        require_once app_path('Helpers/ZplPrinter.php');
        PrinterQueue::observe(PrintObserver::class);
    }
}
