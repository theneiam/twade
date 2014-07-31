<?php
/**
 * Twigger
 *
 * @author: Eugene I. Nezhuta <eugene.nezhuta@gmail.com>
 */

namespace Twade\Engine\Wrappers;

class Twigger extends Base
{
    public function __construct($options)
    {
        if (!isset($options['templatesPath'])) {
            throw new \Exception('RequiredOptionsNotSet');
        }

        $this->engine = new \Twig_Environment(
            new \Twig_Loader_Filesystem($options['templatesPath'])
        );
    }

    /**
     * Render template and assign variables, if passed
     *
     * @param string $template Path to twig template
     * @param array $variables Associative array of variables to assign, will overwrite any other if much
     * @return string Rendered template
     */
    public function render($template, $variables = array())
    {
        if (!empty($variables)) {
            $this->variables = array_merge($this->variables, $variables);
        }

        return $this->engine->render($template, $this->variables);
    }
} 