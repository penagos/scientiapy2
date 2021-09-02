<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::directive(
            'date', function ($date) {
                return "<?php echo ($date == '') ? '' : date('Y-m-d', strtotime($date)); ?>";
            }
        );

        Blade::directive(
            'edited', function ($edited) {
                return "<?php echo ($edited) ? '<i class=\"bi bi-pencil\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edited\"></i>' : ''; ?>";
            }
        );
    }
}
