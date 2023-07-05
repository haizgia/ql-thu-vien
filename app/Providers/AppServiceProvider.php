<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Blade::directive('datetime', function ($expression) {
            // $date = new DateTimeImmutable($expression);
            return "<?php echo Carbon\Carbon::parse($expression)->format('d-m-Y')?>";
        });
        Blade::directive('statusdate', function ($expression) {
            return
            "<?php
                Carbon\Carbon::setLocale('vi'); // hiển thị ngôn ngữ tiếng việt.
                echo Carbon\Carbon::create($expression)->diffForHumans(Carbon\Carbon::now());
            ?>";
        });
    }
}
