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

        Blade::directive('numeral', function ($expression) {
            $expression = explode(',', $expression);
            if (count($expression) == 1 || in_array(trim($expression[1]), array('\'f\'', '\'m\'', '\'n\'')))
                return '<?php echo morphos\\Russian\\CardinalNumeral::generate('.$expression[0].(isset($expression[1]) ? ','.$expression[1] : null).') ?>';
            else
                return '<?php echo morphos\\Russian\\CardinalNumeral::generate('.$expression[0].(isset($expression[2]) ? ','.$expression[2] : null).') ?> <?php echo morphos\\Russian\\Plurality::pluralize('.$expression[1].','.$expression[0].'); ?>';
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
