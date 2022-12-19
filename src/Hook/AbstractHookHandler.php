<?php

namespace BelVG\ModuleCore\Hook;

use Module;

abstract class AbstractHookHandler
{
    /**
     * @var Module
     */
    protected $module;

    /**
     * @param Module $module
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
    }
}
