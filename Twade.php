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
            'engine'        => Twade\Engine\View::VIEW_ENGINE_TWIG,
            'templatesPath' => __DIR__ . '/example/twig/',
            'cache'         => __DIR__ . '/../../cache/'
        );

        // Create view
        $this->_view = Twade\Engine\View::create($options);

        // Assign some vars
        $this->_view->welcome = 'Welcome to the TwAde plugin!';
        $this->_view->engine   = 'Twig';

        // Disco!
        echo $this->_view->render('welcome.twig');
    }

    public function bladeAction()
    {
        // Define options
        $options = array(
            'engine'        => Twade\Engine\View::VIEW_ENGINE_BLADE,
            'templatesPath' => __DIR__ . '/example/blade/',
            'cache'         => __DIR__ . '/../../cache/'
        );

        // Create view
        $this->_view = Twade\Engine\View::create($options);

        // Assign some vars
        $this->_view->welcome = 'Welcome to the TwAde plugin!';
        $this->_view->engine   = 'Blade';

        // Disco!
        echo $this->_view->render('welcome');
    }
} 