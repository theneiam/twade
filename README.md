TWADE
=====

[![Code Climate](https://codeclimate.com/github/theneiam/twade/badges/gpa.svg)](https://codeclimate.com/github/theneiam/twade)
[![Latest Stable Version](https://poser.pugx.org/theneiam/twade/v/stable.svg)](https://packagist.org/packages/theneiam/twade) [![Total Downloads](https://poser.pugx.org/theneiam/twade/downloads.svg)](https://packagist.org/packages/theneiam/twade) [![Latest Unstable Version](https://poser.pugx.org/theneiam/twade/v/unstable.svg)](https://packagist.org/packages/theneiam/twade) [![License](https://poser.pugx.org/theneiam/twade/license.svg)](https://packagist.org/packages/theneiam/twade)

TwAde is the plugin for the [SEO Toaster](http://www.seotoaster.com/) CMS

With TwAde it is very easy to start using the power of the popular template engines, such as
[Twig](http://twig.sensiolabs.org/), [Blade](http://laravel.com/docs/templates) or [Mustache](https://github.com/bobthecow/mustache.php/wiki),
within your plugins or, even, in the SEO Toaster's core!

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

Example of how to use power of the famous template engines with TwAde.
*you can find some demos in the Twade.php*

```php
// Define config options.

// Twig engine options. It supports Twig extensions now!
$options = array(
    'engine'        => 'Twig',
    'templatesPath' => __DIR__ . '/example/twig/',
    'cache'         => __DIR__ . '/../../cache/',
    'extensions'    => array(
        'Twig_Extensions_Extension_I18n' // The i18n extension only works if the PHP gettext extension is enabled.
    )
);

// Blade engine options
$options = array(
    'engine'        => 'Blade',
    'templatesPath' => __DIR__ . '/example/blade/',
    'cache'         => __DIR__ . '/../../cache/'
);

// Mustache engine options. Yeah! Twade supports mustache from now on!
$options = array(
    'engine'        => 'Mustache',
    'templatesPath' => __DIR__ . '/example/mustache',
    'cache'         => __DIR__ . '/../../cache/'
);

// Now, let's create a view and enjoy
// Create view
$view = \Twade\Engine\Factory::create($options);

// Assign some vars
$view->welcome = 'Welcome to the TwAde plugin!';

// Disco!
echo $this->_view->render('welcome');
```
