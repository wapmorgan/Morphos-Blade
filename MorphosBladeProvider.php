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
            return '<?php echo \'.morphos\\Russian\\pluralize('.$expression.'); ?>';
        });

        // @numeral(number)
        // @numeral(number, gender)
        // @numeral(number, noun)
        // @numeral(number, noun, gender)
        Blade::directive('numeral', function ($expression) {
            $expression = explode(',', $expression);
            if (count($expression) == 1 || in_array(trim($expression[1]), array('\'f\'', '\'m\'', '\'n\'')))
                return '<?php echo \\morphos\\Russian\\CardinalNumeralGenerator::getCase('.$expression[0].', \\morphos\\Cases::NOMINATIVE'.(isset($expression[1]) ? ' ,'.$expression[1] : null).') ?>';
            else
                return '<?php echo \\morphos\\Russian\\CardinalNumeralGenerator::getCase('.$expression[0].', \\morphos\\Cases::NOMINATIVE'.(isset($expression[2]) ? ' ,'.$expression[2] : null).') ?> <?php echo morphos\\Russian\\NounPluralization::pluralize('.$expression[1].','.$expression[0].'); ?>';
        });

        // @ordinal(number)
        // @ordinal(number, gender)
        Blade::directive('ordinal', function ($expression) {
            $expression = explode(',', $expression);
            if (count($expression) == 2)
                return '<?php echo \\morphos\\Russian\\OrdinalNumeralGenerator::getCase('.$expression[0].', \\morphos\\Cases::NOMINATIVE, '.$expression[1].') ?>';
            else
                return '<?php echo \\morphos\\Russian\\OrdinalNumeralGenerator::getCase('.$expression[0].', \\morphos\\Cases::NOMINATIVE) ?>';
        });

        // @money(value, currency)
        Blade::directive('money', function ($expression) {
            return '<?php echo \\morphos\\Russian\\MoneySpeller::spell('.$expression.', \\morphos\\Russian\\MoneySpeller::SHORT_FORMAT) ?>';
        });

        // @name(name, case)
        // @name(name, gender, case)
        Blade::directive('name', function ($expression) {
            $expression = explode(',', $expression);
            if (count($expression) == 2)
                return '<?php echo \\morphos\\Russian\\inflectName('.$expression[0].','.$expression[1].'); ?>';
            else
                return '<?php echo \\morphos\\Russian\\inflectName('.$expression[0].','.$expression[2].','.$expression[1].'); ?>';
        });
    }

    public function register() {}
}
