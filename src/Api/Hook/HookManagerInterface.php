<?php

namespace BelVG\ModuleCore\Api\Hook;

use Module;

interface HookManagerInterface
{
    /**
     * Hook handler class postfix
     */
    const HOOK_HANDLER_POSTFIX = 'HookHandler';

    /**
     * @return bool
     */
    public function registerHooks();

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function handle($name, $arguments);
}
