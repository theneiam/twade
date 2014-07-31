TWADE
=====

[![Code Climate](https://codeclimate.com/github/theneiam/twade/badges/gpa.svg)](https://codeclimate.com/github/theneiam/twade)
[![Latest Stable Version](https://poser.pugx.org/theneiam/twade/v/stable.svg)](https://packagist.org/packages/theneiam/twade) [![Total Downloads](https://poser.pugx.org/theneiam/twade/downloads.svg)](https://packagist.org/packages/theneiam/twade) [![Latest Unstable Version](https://poser.pugx.org/theneiam/twade/v/unstable.svg)](https://packagist.org/packages/theneiam/twade) [![License](https://poser.pugx.org/theneiam/twade/license.svg)](https://packagist.org/packages/theneiam/twade)

TwAde is the plugin for the [SEO Toaster](http://www.seotoaster.com/) CMS

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
