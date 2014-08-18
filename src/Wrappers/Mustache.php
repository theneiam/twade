<?php

/**
 * ****************************************************
 *
 * Mustache.php
 *
 * @author: Eugene I. Nezhuta <eugene.nezhuta@gmail.com>
 *
 * *****************************************************
 */

namespace Twade\Engine\Wrappers;

class Mustache extends Base
{
    public function __construct($options = array())
    {
        $fsLoader = new \Mustache_Loader_FilesystemLoader($options['templatesPath']);

        $this->engine = new \Mustache_Engine(array(
            'cache'  => $options['cache'],
            'loader' => $fsLoader
        ));
    }

    public function render($template, $variables = array())
    {
        if (!empty($variables)) {
            $this->variables = array_merge($this->variables, $variables);
        }

        return $this->engine->render($template, $this->variables);
    }
}