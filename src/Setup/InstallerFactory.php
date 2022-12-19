<?php

namespace BelVG\ModuleCore\Setup;

use BelVG\ModuleCore\Api\Setup\InstallerInterface;
use BelVG\ModuleCore\Exception\ClassDoesNotExistException;
use BelVG\ModuleCore\Exception\WrongEntityTypeException;

class InstallerFactory
{
    /**
     * @return InstallerInterface
     * @throws ClassDoesNotExistException
     * @throws WrongEntityTypeException
     */
    public static function create($instanceName)
    {
        if (!class_exists($instanceName)) {
            throw new ClassDoesNotExistException(sprintf('Cannot find class %s', $instanceName));
        }

        $installer = new $instanceName();
        if (!($installer instanceof InstallerInterface)) {
            throw new WrongEntityTypeException(sprintf('%s is not an instance of the %s', $instanceName, InstallerInterface::class));
        }

        return $installer;
    }
}
