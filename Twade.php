<?php
/**
 * Twade
 *
 * Date: 25.07.14
 * Time: 8:47
 * @author: Eugene I. Nezhuta <eugene.nezhuta@gmail.com>
 */

require 'vendor/autoload.php';

class Twade extends Tools_Plugins_Abstract
{
    public function twigAction()
    {
        // Define options
        $options = array(
            'engine'        => 'Twig',
            'templatesPath' => __DIR__ . '/example/twig/',
            'cache'         => __DIR__ . '/../../cache/',
            'extensions'    => array(
                'Twig_Extensions_Extension_I18n' // The i18n extension only works if the PHP gettext extension is enabled.
            )
        );

        // Create view
        $this->_view = \Twade\Engine\Factory::create($options);

        // Assign some vars
        $this->_view->welcome = 'Welcome to the TwAde plugin!';
        $this->_view->engine  = 'Twig';

        // Disco!
        echo $this->_view->render('welcome.twig');
    }

    public function bladeAction()
    {
        // Define options
        $options = array(
            'engine'        => 'Blade',
            'templatesPath' => __DIR__ . '/example/blade/',
            'cache'         => __DIR__ . '/../../cache/'
        );

        // Create view
        $this->_view = \Twade\Engine\Factory::create($options);

        // Assign some vars
        $this->_view->welcome = 'Welcome to the TwAde plugin!';
        $this->_view->engine  = 'Blade';

        // Disco!
        echo $this->_view->render('welcome');
    }

    public function mustacheAction()
    {
        // Define options
        $options = array(
            'engine'        => 'Mustache',
            'templatesPath' => __DIR__ . '/example/mustache',
            'cache'         => __DIR__ . '/../../cache/'
        );

        // Create view
        $this->_view = \Twade\Engine\Factory::create($options);

        // Assign some vars
        $this->_view->welcome = 'Welcome to the TwAde plugin!';
        $this->_view->engine  = 'Mustache';

        // Disco!
        $r = $this->_view->render('welcome');
        echo $this->_view->render('welcome');
    }
} 