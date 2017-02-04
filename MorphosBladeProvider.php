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

        Blade::directive('money', function ($expression) {
            $expression = explode(',', $expression);
            $money = (float)trim($expression[0], '\'');
            $money_type = mb_strtolower(trim($expression[1], '\' '));
            $money_big = floor($money);
            $money_little = floor($money * 100 % 100);
            switch ($money_type) {
                case '₽':
                case 'р':
                case 'рубль':
                case 'r':
                case 'rub':
                    return $money_big.' <?php echo morphos\\Russian\\Plurality::pluralize(\'рубль\', '.$money_big.') ?> '.$money_little.' <?php echo morphos\\Russian\\Plurality::pluralize(\'копейка\', '.$money_little.') ?>';
                case '$':
                case 'доллар':
                case 'u':
                case 'usd':
                    return $money_big.' <?php echo morphos\\Russian\\Plurality::pluralize(\'доллар\', '.$money_big.') ?> '.$money_little.' <?php echo morphos\\Russian\\Plurality::pluralize(\'цент\', '.$money_little.') ?>';
                case '€':
                case 'евро':
                case 'e':
                case 'euro':
                    return $money_big.' <?php echo morphos\\Russian\\Plurality::pluralize(\'евро\', '.$money_big.') ?> '.$money_little.' <?php echo morphos\\Russian\\Plurality::pluralize(\'цент\', '.$money_little.') ?>';
                default:
                    return '<?php echo ('.$expression[0].').\' \'.('.$expression[1].') ?>';
            }
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
