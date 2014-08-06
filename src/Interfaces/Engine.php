<?php
/**
 * Wrapper.php
 * 
 * Date: 8/5/14
 * Time: 10:42 AM
 * @author: Eugene I. Nezhuta <eugene.nezhuta@gmail.com>
 */

namespace Twade\Engine\Interfaces;

interface Engine
{
    public function render($template, $variables = array());
} 