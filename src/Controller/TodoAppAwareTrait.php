<?php

namespace PhpKansai\TodoManager\Controller;

use PhpKansai\TodoManager\Model\TodoRepository;

trait TodoAppAwareTrait
{
    /** @var \Silex\Application */
    protected $app;

    /**
     * @param \Silex\Application $app
     */
    function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @return \Twig_Environment
     */
    protected function getTwig()
    {
        return $this->app['twig'];
    }

    /**
     * @return TodoRepository
     */
    protected function getTodoRepository()
    {
        return $this->app['todo.repository'];
    }
}