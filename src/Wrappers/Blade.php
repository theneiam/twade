<?php

/**
 * ****************************************************
 *
 * Blade.php
 *
 * @author: Eugene I. Nezhuta <eugene.nezhuta@gmail.com>
 *
 * *****************************************************
 */

namespace Twade\Engine\Wrappers;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Factory;

class Blade extends Base
{
    /**
     * Array containg paths where to look for blade files
     *
     * @var array
     */
    public $viewPaths = '';

    /**
     * Location where to store cached views
     *
     * @var string
     */
    public $cachePath = '';

    protected $container = null;

    protected $instance = null;

    protected $variables = array();

    /**
     * Initialize class
     *
     * @param array $viewPaths
     * @param string $cachePath
     */
    function __construct(array $viewPaths, $cachePath)
    {

        $this->container = new Container();
        $this->viewPaths = $viewPaths;
        $this->cachePath = $cachePath;

        $this->registerFileSystem()
            ->registerEvents()
            ->registerEngineResolver()
            ->registerViewFinder();

        $this->instance = $this->getViewFactory();
    }

    protected function registerFileSystem()
    {
        $this->container->bindShared(
            'files',
            function () {
                return new Filesystem();
            }
        );

        return $this;
    }

    protected function registerEvents()
    {
        $this->container->bindShared(
            'events',
            function () {
                return new Dispatcher();
            }
        );

        return $this;
    }

    protected function registerEngineResolver()
    {
        $this->container->bindShared(
            'view.engine.resolver',
            function () {
                $resolver = new EngineResolver();
                array_map(
                    function ($engine) use ($resolver) {
                        $this->{'register' . ucfirst($engine) . 'Engine'}($resolver);
                    },
                    array('php', 'blade')
                );
                return $resolver;
            }
        );

        return $this;
    }

    /**
     * Register the PHP engine implementation.
     *
     * @param  \Illuminate\View\Engines\EngineResolver $resolver
     * @return void
     */
    protected function registerPhpEngine($resolver)
    {
        $resolver->register(
            'php',
            function () {
                return new PhpEngine;
            }
        );
    }

    /**
     * Register the Blade engine implementation.
     *
     * @param  \Illuminate\View\Engines\EngineResolver $resolver
     * @return void
     */
    protected function registerBladeEngine($resolver)
    {
        $app = $this->container;

        $this->container->bindShared(
            'blade.compiler',
            function ($app) {
                $cache = $this->cachePath;

                return new BladeCompiler($app['files'], $cache);
            }
        );

        $resolver->register(
            'blade',
            function () use ($app) {
                return new CompilerEngine($app['blade.compiler'], $app['files']);
            }
        );
    }

    /**
     * Register the view finder implementation.
     *
     * @return void
     */
    protected function registerViewFinder()
    {
        $this->container->bindShared(
            'view.finder',
            function ($app) {
                $paths = $this->viewPaths;
                return new FileViewFinder($app['files'], $paths);
            }
        );
    }

    /**
     *
     * @return Factory
     */
    protected function getViewFactory()
    {
        $factory  = new Factory(
            $this->container['view.engine.resolver'],
            $this->container['view.finder'],
            $this->container['events']
        );

        $factory->setContainer($this->container);
        return $factory;
    }

    public function render($template, $variables = array())
    {
        if (!empty($variables)) {
            $this->variables = array_merge($this->variables, $variables);
        }

        return $this->instance
            ->make($template)
            ->with($this->variables);
    }
} 