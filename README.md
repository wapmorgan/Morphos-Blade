# MorphosBlade

[![Composer package](http://xn--e1adiijbgl.xn--p1acf/badge/wapmorgan/morphos-blade)](https://packagist.org/packages/wapmorgan/morphos-blade)
[![Latest Stable Version](https://poser.pugx.org/wapmorgan/morphos-blade/version)](https://packagist.org/packages/wapmorgan/morphos-blade)
[![License](https://poser.pugx.org/wapmorgan/morphos-blade/license)](https://packagist.org/packages/wapmorgan/morphos-blade)

Adds a @plural and @name tags to Laravel's Blade templating engine for Russian pluralization and declenation.

```blade
<div>
@plural(252, 'новость') от @name('Иванов Иван Иванович', 'genetivus')
</div>
```

Will be compiled in

```html
<div>
252 новости от Иванова Ивана Ивановича
</div>
```

- **@plural** - Get plural form of word. Just pass count of objects and noun.
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
