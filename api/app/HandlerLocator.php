<?php

declare(strict_types=1);

namespace App;

use Illuminate\Container\Container;
use Joselfonseca\LaravelTactician\Locator\LocatorInterface;

class HandlerLocator implements LocatorInterface
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getHandlerForCommand($commandName)
    {
        return $this->container->make(substr($commandName, 0, -7) . "Handler");
    }

    public function addHandler($handler, $commandClassName)
    {
        // Added because bus requests LocatorInterface implemented class
    }

    public function addHandlers(array $commandClassToHandlerMap)
    {
        // Added because bus requests LocatorInterface implemented class
    }
}
