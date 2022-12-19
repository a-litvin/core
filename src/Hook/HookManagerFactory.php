<?php

namespace BelVG\ModuleCore\Hook;

use BelVG\ModuleCore\Api\Hook\HookManagerInterface;
use BelVG\ModuleCore\Exception\ClassDoesNotExistException;
use BelVG\ModuleCore\Exception\WrongEntityTypeException;
use Module;

class HookManagerFactory
{
    /**
     * @param string $instanceName
     * @param Module $module
     * @param array $hooks
     * @return HookManagerInterface
     * @throws ClassDoesNotExistException
     * @throws WrongEntityTypeException
     */
    public static function create($instanceName, Module $module, array $hooks)
    {
        if (!class_exists($instanceName)) {
            throw new ClassDoesNotExistException(sprintf('Cannot find class %s', $instanceName));
        }

        $hookManager = new $instanceName($module, $hooks);
        if (!($hookManager instanceof HookManagerInterface)) {
            throw new WrongEntityTypeException(sprintf('%s is not an instance of the %s', $instanceName, HookManagerInterface::class));
        }

        return $hookManager;
    }

}
