<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::directive(
            'date', function ($date) {
                return "<?php echo ($date == '') ? '' : date('m/d/Y', strtotime($date)); ?>";
            }
        );

        Blade::directive(
            'datetime', function ($date) {
                return "<?php echo ($date == '') ? '' : date('m/d/Y H:i', strtotime($date)); ?>";
            }
        );

        Blade::directive(
            'edited', function ($edited) {
                return "<?php echo ($edited) ? '<i class=\"bi bi-pencil\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edited\"></i>' : ''; ?>";
            }
        );

        Blade::directive(
            'errorMessage', function ($message) {
                return "<div class=\"alert alert-danger small mt-2 p-1\" role=\"alert\"><?php echo $message; ?></div>";
            }
        );
    }
}
