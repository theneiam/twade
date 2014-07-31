<?php
/**
 * View
 *
 * Date: 25.07.14
 * Time: 11:46
 * @author: Eugene I. Nezhuta <eugene.nezhuta@gmail.com>
 */

namespace Twade\Engine;

use Twade\Engine\Exceptions\EngineNotSetException;
use Twade\Engine\Exceptions\BootstrapNotFoundException;
use Twade\Engine\Wrappers\Twigger;
use Twade\Engine\Wrappers\Blader;

class View
{
    const VIEW_ENGINE_TWIG  = 'TWIG';

    const VIEW_ENGINE_BLADE = 'BLADE';

    public static function wrap(\Zend_View_Interface $view, $engine = self::VIEW_ENGINE_TWIG)
    {
        $templatesPath = $view->getScriptPaths();
        return new Twigger(array(
            'templatesPath' => $templatesPath
        ));
    }

    /**
     * @param array $options
     * @return mixed Twade\Engine\Wrappers\Blader|Twade\Engine\Wrappers\Twigger
     * @throws Exceptions\EngineNotSetException
     * @throws Exceptions\BootstrapNotFoundException
     */
    public static function create(array $options = array())
    {
        // Init some defaults
        $options = array_merge(
            array(
                'engine'        => self::VIEW_ENGINE_TWIG,
                'templatesPath' => __DIR__ . '/views',
                'cache'         => null
            ),
            $options
        );

        if (empty($options['engine'])) {
            throw new EngineNotSetException('You must specify an engine to bootstrap', 400);
        }

        $bootstrapper = 'bootstrap' . ucfirst(strtolower($options['engine']));

        if (!method_exists(__CLASS__, $bootstrapper)) {
            throw new BootstrapNotFoundException('Bootstrap callable not found.', 400);
        }

        return static::$bootstrapper($options);
    }

    private static function bootstrapTwig($options)
    {
        return new Twigger($options);
    }

    private static function bootstrapBlade($options)
    {
        return new Blader(array($options['templatesPath']), $options['cache']);
    }
}