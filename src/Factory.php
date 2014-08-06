<?php

/**
 * ****************************************************
 *
 * Factory.php
 *
 * @author: Eugene I. Nezhuta <eugene.nezhuta@gmail.com>
 *
 * *****************************************************
 */

namespace Twade\Engine;

use Twade\Engine\Exceptions\BootstrapException;
use Twade\Engine\Exceptions\EngineNotSetException;
use Twade\Engine\Exceptions\OptionsEmptyException;

class Factory
{
    /**
     * Default wrappers namespace. Will be used while composing correct wrapper name.
     */
    const ENGINES_NS = 'Twade\\Engine\\Wrappers\\';

    /**
     * Create a view object.
     *
     * @param array $options
     * @return Interfaces\Engine
     * @throws Exceptions\EngineNotSetException
     * @throws Exceptions\OptionsEmptyException
     * @throws Exceptions\BootstrapException
     */
    public static function create(array $options = array())
    {
        // options are malformed
        if (empty($options)) {
            throw new OptionsEmptyException('Options cannot be empty!', 400);
        }

        // engine not passed
        if (empty($options['engine'])) {
            throw new EngineNotSetException('You must specify a view engine', 400);
        }

        // prepare options and wrapper
        $engineWrapper = self::ENGINES_NS . ucfirst(strtolower($options['engine']));
        unset($options['engine']);

        // create view engine
        try {
            $engine = new $engineWrapper($options);
        } catch (\Exception $e) {
            $err = sprintf('Cant load view engine wrapper for %s! Error occurred: %s', $engineWrapper, $e->getMessage());
            throw new BootstrapException($err, 400);
        }

        return $engine;
    }
}