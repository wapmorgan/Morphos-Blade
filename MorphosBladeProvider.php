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
            $expression = array_reverse(explode(',', $expression));
            return $expression[1].' <?php echo morphos\\Russian\\Plurality::pluralize('.implode(',', $expression).'); ?>';
        });

        Blade::directive('name', function ($expression) {
            $expression = explode(',', $expression);
            if (count($expression) == 2)
                return '<?php echo morphos\\Russian\\nameCase('.$expression[0].','.$expression[1].'); ?>';
            else
                return '<?php echo morphos\\Russian\\nameCase('.$expression[0].','.$expression[2].','.$expression[1].'); ?>';
        });
    }

    public function register(){}
}
