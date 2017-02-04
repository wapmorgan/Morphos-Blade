# MorphosBlade

[![Composer package](http://xn--e1adiijbgl.xn--p1acf/badge/wapmorgan/morphos-blade)](https://packagist.org/packages/wapmorgan/morphos-blade)
[![Latest Stable Version](https://poser.pugx.org/wapmorgan/morphos-blade/version)](https://packagist.org/packages/wapmorgan/morphos-blade)
[![License](https://poser.pugx.org/wapmorgan/morphos-blade/license)](https://packagist.org/packages/wapmorgan/morphos-blade)

Adds a @plural, @name, @numeral and @money tags to Laravel's Blade templating engine for Russian pluralization and declenation.

```blade
<div>
@plural(252, 'новость') от @name('Иванов Иван Иванович', 'genetivus')
@numeral(565)
@money(123.50, '₽')
</div>
```

Will be compiled in

```html
<div>
252 новости от Иванова Ивана Ивановича
пятьсот шестьдесят пять
сто двадцать три рубля пятьдесят копеек
</div>
```

- **@plural** - Get plural form of word. Just pass count of objects and noun.
- **@numeral(number)** - Get numeral of a number. Just pass number.
- **@numeral(number, gender)** - Get numeral of a number. Just pass number and gender (m or f or n).
- **@numeral(number, noun)** - Get numeral with a pluralized noun. Just pass number and noun.
- **@numeral(number, noun, gender)** - Get numeral with a pluralized noun. Just pass number, noun and gender (m or f or n).
- **@money(value, type)** - Get money formatted as text string. Just pass value and type (₽ or $ or €).
- **@name(name, case)** - Get any case of fullname with gender detection.
- **@name(name, gender, case)** - Get any case of fullname. Just pass name, gender (m or w or null) and case (genetivus, dativus, accusative, ablativus, praepositionalis).

## Installation

### Get the Package

```
composer require wapmorgan/morphos-blade
```

### Register the Service Provider
Open up your `app.php` in your `config` folder, and add the following line to
your `providers` list like:

```php
'providers' => array(
    ...
    morphos\MorphosBladeProvider::class
)
```
