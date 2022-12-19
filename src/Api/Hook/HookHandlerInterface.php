<?php

namespace BelVG\ModuleCore\Api\Hook;

interface HookHandlerInterface
{
    /**
     * @param array $arguments
     * @return mixed
     */
    public function process($arguments);
}
