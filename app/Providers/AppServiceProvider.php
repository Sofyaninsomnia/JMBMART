<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;
use Illuminate\Pagination\Paginator;

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
        Blade::directive('activeclass', function ($expression) {

            return "<?php
                \$__args = array_map('trim', explode(',', {$expression}, 2));
                \$__pattern = trim(\$__args[0], \" '\\\"\");
                \$__class = isset(\$__args[1])
                    ? trim(\$__args[1], \" '\\\"\")
                    : 'collapsed';
                echo Request::is(\$__pattern) ? '' : \$__class;
            ?>";
        });
        Blade::directive('rupiah', function ($value) {
            return "<?php echo 'Rp ' . number_format($value, 0, ',', '.'); ?>";
        });
        Paginator::useBootstrapFive();
    }
}
