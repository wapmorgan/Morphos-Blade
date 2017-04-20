<?php
namespace morphos;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MorphosBladeProvider extends ServiceProvider {

    protected $currencies = array();

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot() {
        // @plural(count, noun)
        Blade::directive('plural', function ($expression) {
            $expression = array_reverse(explode(',', $expression));
            return '<?php echo ('.$expression[1].').\' \'.morphos\\Russian\\Plurality::pluralize('.implode(',', $expression).'); ?>';
        });

        // @numeral(number)
        // @numeral(number, gender)
        // @numeral(number, noun)
        // @numeral(number, noun, gender)
        Blade::directive('numeral', function ($expression) {
            $expression = explode(',', $expression);
            if (count($expression) == 1 || in_array(trim($expression[1]), array('\'f\'', '\'m\'', '\'n\'')))
                return '<?php echo morphos\\Russian\\CardinalNumeral::getCase('.$expression[0].', morphos\\Cases::NOMINATIVE'.(isset($expression[1]) ? ' ,'.$expression[1] : null).') ?>';
            else
                return '<?php echo morphos\\Russian\\CardinalNumeral::generate('.$expression[0].', morphos\\Cases::NOMINATIVE'.(isset($expression[2]) ? ' ,'.$expression[2] : null).') ?> <?php echo morphos\\Russian\\Plurality::pluralize('.$expression[1].','.$expression[0].'); ?>';
        });

        // @ordinal(number)
        // @ordinal(number, gender)
        Blade::directive('ordinal', function ($expression) {
            $expression = explode(',', $expression);
            if (count($expression) == 2)
                return '<?php echo morphos\\Russian\\OrdinalNumeral::getCase('.$expression[0].', morphos\\Cases::NOMINATIVE, '.$expression[1].') ?>';
            else
                return '<?php echo morphos\\Russian\\OrdinalNumeral::getCase('.$expression[0].', morphos\\Cases::NOMINATIVE) ?>';
        });

        // @money(value, currency)
        Blade::directive('money', function ($expression) {
            $expression = explode(',', $expression);
            $money = '(float)trim('.$expression[0].', \'\\\'\')';
            $currency = mb_strtolower(trim($expression[1], '\' '));
            $money_big = 'floor('.$money.')';
            $money_little = 'floor('.$money.' * 100 % 100)';
            switch ($currency) {
                case '₽':
                case 'р':
                case 'рубль':
                case 'r':
                case 'rub':
                    $currency = array('рубль', 'копейка');
                    break;

                case '₴':
                case 'г':
                case 'гривна':
                case 'uah':
                    $currency = array('гривна', 'копейка');
                    break;

                case '$':
                case 'доллар':
                case 'u':
                case 'usd':
                    $currency = array('доллар', 'цент');
                    break;

                case '€':
                case 'евро':
                case 'e':
                case 'eur':
                case 'euro':
                    $currency = array('евро', 'цент');
                    break;

                case '£':
                case 'фунт':
                case 'gbp':
                    $currency = array('фунт', 'пенни');
                    break;

                default:
                    return '<?php echo ('.$expression[0].').\' \'.('.$expression[1].') ?>';
            }

            return '<?php echo '.$money_big.'.\' \'.morphos\\Russian\\Plurality::pluralize(\''.$currency[0].'\', '.$money_big.') ?> <?php echo '.$money_little.'.\' \'.morphos\\Russian\\Plurality::pluralize(\''.$currency[1].'\', '.$money_little.') ?>';

        });

        // @name(name, case)
        // @name(name, gender, case)
        Blade::directive('name', function ($expression) {
            $expression = explode(',', $expression);
            if (count($expression) == 2)
                return '<?php echo morphos\\Russian\\name('.$expression[0].','.$expression[1].'); ?>';
            else
                return '<?php echo morphos\\Russian\\name('.$expression[0].','.$expression[2].','.$expression[1].'); ?>';
        });
    }

    public function register() {}
}
