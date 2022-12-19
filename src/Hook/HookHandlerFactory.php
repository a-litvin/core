<?php

namespace BelVG\ModuleCore\Hook;

use BelVG\ModuleCore\Api\Hook\HookHandlerInterface;
use BelVG\ModuleCore\Exception\ClassDoesNotExistException;
use BelVG\ModuleCore\Exception\WrongEntityTypeException;
use Module;

class HookHandlerFactory
{
    /**
     * @return HookHandlerInterface
     * @throws WrongEntityTypeException
     * @throws ClassDoesNotExistException
     */
    public static function create($instanceName, Module $module)
    {
        if (!class_exists($instanceName)) {
            throw new ClassDoesNotExistException(sprintf("%s doesn't exists", $instanceName));
        }

        $instance = new $instanceName($module);
        if (!$instance instanceof HookHandlerInterface) {
            throw new WrongEntityTypeException(sprintf("%s isn't an instance of %s", $instanceName, HookHandlerInterface::class));
        }

        return $instance;
    }
}
