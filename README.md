# MorphosBlade

Adds a @plural and @name tags to Laravel's Blade templating engine for Russian pluralization and declenation.

```blade
<div>
@plural(251, 'новость') от @name('Иванов Иван Иванович', 'm', 'genetivus')
</div>
```

Will be compiled in

```html
<div>
251 новость от Иванова Ивана Ивановича
</div>
```

- @plural - Get plural form of word. Just pass count of objects and noun.
- @name - Get any case of fullname. Just pass name, gender (m or w) and case (genetivus, dativus, accusative, ablativus, praepositionalis).

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
