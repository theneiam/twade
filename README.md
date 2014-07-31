TWADE
=====
TwAde is the plugin for the Seotoaster 2.x CMS

## INSTALLATION

### Manual

1. Download or clone plugin from GitHub to your *Seotoaster* plugins directory
2. Go to the *twade* directory and run composer install command
3. Disco

### Via [Composer](http://getcomposer.org)

```bash
$ curl -s https://getcomposer.org/installer | php
```

* Now, change your composer.json

```yaml
{
    "require": {
        "theneiam/twade": "dev-master"
    }
}
```

* And install

```bash
$ composer install
```

* Disco!

## USEAGE

Example of how to use power of the Twig engine with TwAde
But if you would like to use Blade, it is as easy as pie,
Just change the configuration options and that's it!

*you can find some demos in the Twade.php*

```php

    // Define config options. We will use Twig engine
    $options = array(
        'engine'        => Twade\Engine\View::VIEW_ENGINE_TWIG,
        'templatesPath' => __DIR__ . '/example/twig/',
        'cache'         => __DIR__ . '/../../cache/'
    );

    // Now, let's create a view and enjoy
    $view = Twade\Engine\View::create($options);

    // Assign some vars
    $view->welcome = 'Welcome to the Twage plugin!';
    $view->engine  = 'Twig';

    // Disco!
    echo $view->render('welcome.twig');
```
