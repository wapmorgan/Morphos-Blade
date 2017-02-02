# MorphosBlade

Adds a @plural and @name tags to Laravel's Blade templating engine.

```blade
<div>
    @plural($count, 'новость')
</div>
```

## Installation
### Get the Package
```
composer require wapmorgan/morphos-blade
```

### Register the Service Provider
Open up your `app.php` in your `config` folder, and add the following line to
your `providers` list like:

```
'providers' => array(
    ...
    morphos\BladeProvider::class
)
```