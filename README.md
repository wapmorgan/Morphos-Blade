# MorphosBlade

[![Composer package](http://xn--e1adiijbgl.xn--p1acf/badge/wapmorgan/morphos-blade)](https://packagist.org/packages/wapmorgan/morphos-blade)
[![Latest Stable Version](https://poser.pugx.org/wapmorgan/morphos-blade/version)](https://packagist.org/packages/wapmorgan/morphos-blade)
[![License](https://poser.pugx.org/wapmorgan/morphos-blade/license)](https://packagist.org/packages/wapmorgan/morphos-blade)

Adds a @plural, @name, @numeral and @money tags to Laravel's Blade templating engine for Russian pluralization and declenation.

```blade
<div>
@plural(252, 'новость') от @name('Иванов Иван Иванович', 'genetivus')
@numeral(565, 'сообщение', 'n') и @money(123.50, '₽') за Ваше отсутствие.
</div>
```

Will be compiled in

```html
<div>
252 новости от Иванова Ивана Ивановича
пятьсот шестьдесят пять сообщений и 123 рубля 50 копеек за Ваше отсутствие
</div>
```

Most popular directives:

- **@plural(count, noun)** - Get plural form of word. Just pass count of objects and noun.
    ```blade
    @plural(244, 'элемент')
    ```
    
- **@money(value, currency)** - Get money formatted as text string. Just pass value and currency (₽ or $ or € or ₴ or £).
    ```blade
    @money(1000.10, '$')
    ```
    
- **@numeral(number)** - Get numeral of a number. Just pass number.
    ```blade
    @numeral(344)
    ```
    
- **@name(name, case)** - Get any case of fullname with gender detection. Just pass name and case (genetivus or dativus or accusative or ablativus or praepositionalis)
    ```blade
    @name('Коленко Сергей Аркадьевич', 'dativus')
    ```

Additional directives:

- **@name(name, gender, case)** - Get any case of fullname. Just pass name, gender (m or w or null) and case (genetivus, dativus, accusative, ablativus, praepositionalis). Use this directive if middle name is unknown and gender detection can make wrong decision.
    ```blade
    @name('Филимонов Игорь', 'm', 'dativus')
    ```

- **@numeral(number, gender)** - Get numeral of a number. Just pass number and gender (m or f or n) to use correct form of gender-dependent words (один/одно/одна, два/две).
    ```blade
    @numeral(121, 'n')
    ```
    
- **@numeral(number, noun)** - Get numeral and a pluralized noun. Just pass number and noun. It's just a shortcut to `@numeral(3) @plural(3, 'поле')`
    ```blade
    @numeral(3, 'поле')
    ```
    
- **@numeral(number, noun, gender)** - Get numeral and a pluralized noun. Just pass number, noun and gender (m or f or n) to use correct form of gender-dependent words (один/одно/одна, два/две).
    ```blade
    @numeral(101, 'сообщение', 'n')
    ```

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
