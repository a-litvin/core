<?php

namespace BelVG\ModuleCore\Api\Setup;

use Module;

interface InstallerInterface
{
    /**
     * @param Module $module
     * @param array $hooks
     * @return bool
     */
    public function install(Module $module, array $hooks = []);

    /**
     * @return bool
     */
    public function uninstall();
}
