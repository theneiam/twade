<?php
/**
 * Base.php
 * 
 * Date: 7/28/14
 * Time: 11:19 PM
 * @author: Eugene I. Nezhuta <eugene.nezhuta@gmail.com>
 */

namespace Twade\Engine\Wrappers;


abstract class Base
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
            throw new \Exception('TemplateVariableNotSet', 400);
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

    abstract public function render($template, $variables);
} 