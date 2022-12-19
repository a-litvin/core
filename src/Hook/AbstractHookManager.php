<?php

namespace BelVG\ModuleCore\Hook;

use BelVG\ModuleCore\Api\Hook\HookManagerInterface;
use BelVG\ModuleCore\Exception\ClassDoesNotExistException;
use BelVG\ModuleCore\Exception\WrongEntityTypeException;
use Module;

abstract class AbstractHookManager implements HookManagerInterface
{
    /**
     * @var array
     */
    protected $hooks;

    /**
     * @var Module
     */
    protected $module;

    /**
     * @param Module $module
     * @param array $hooks
     */
    public function __construct(
        Module $module,
        array $hooks
    ) {
        $this->module = $module;
        $this->hooks = $hooks;
    }

    /**
     * @return bool
     */
    public function registerHooks()
    {
        $result = true;
        foreach ($this->hooks as $hook) {
            $hookHandlerName = $this->getHookHandlerByName($hook);
            if (class_exists($hookHandlerName)) {
                $result &= $this->module->registerHook($hook);
            }
        }

        return $result;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws ClassDoesNotExistException
     * @throws WrongEntityTypeException
     */
    public function handle($name, $arguments)
    {
        $name = str_replace('hook', '', $name);
        if (in_array($name, $this->hooks)) {
            $hookHandlerName = $this->getHookHandlerByName($name);
            $hookHandler = HookHandlerFactory::create($hookHandlerName, $this->module);
            return $hookHandler->process($arguments);
        }
    }

    /**
     * @param string $name
     * @return string
     */
    abstract protected function getHookHandlerByName($name);
}
