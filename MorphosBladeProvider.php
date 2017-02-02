<?php
namespace morphos;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MorphosBladeProvider extends ServiceProvider {
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('plural', function ($expression) {
            return "<?php echo morphos\\Russian\\Plurality::pluralize($expression); ?>";
        });

        Blade::directive('name', function ($expression) {
            return "<?php echo morphos\\Russian\\nameCase($expression); ?>";
        });
    }

    public function register(){}
}
