<?php

/**
 * ****************************************************
 *
 * Base.php contains TwAde common wrapper class.
 *
 * @author: Eugene I. Nezhuta <eugene.nezhuta@gmail.com>
 *
 * *****************************************************
 */

namespace Twade\Engine\Wrappers;

use Twade\Engine\Exceptions\ViewVariableNotSetException;
use Twade\Engine\Interfaces\Engine;

abstract class Base implements Engine
{
    protected $engine    = null;

    protected $variables = array();

    public function __set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function __get($name)
    {
        if (!isset($this->variables[$name])) {
            throw new ViewVariableNotSetException(sprintf('Variable %s is not set.', $name));
        }
    }

    public function __unset($name)
    {
        if (isset($this->variables[$name])) {
            unset($this->variables[$name]);
        }
    }

    public function __isset($name)
    {
        return isset($this->variables[$name]);
    }

    abstract public function render($template, $variables = array());
} 