<?php

namespace BelVG\ModuleCore\Setup;

use BelVG\ModuleCore\Api\Setup\InstallerInterface;
use BelVG\ModuleCore\Api\Hook\HookManagerInterface;
use Module;
use Db;

abstract class AbstractInstaller implements InstallerInterface
{
    /**
     * @inheritDoc
     */
    public function install(Module $module, array $hooks = [])
    {
        return $this->installDatabase() && $this->registerHooks($module, $hooks);
    }

    /**
     * @inheritDoc
     */
    public function uninstall()
    {
        return $this->uninstallDatabase();
    }

    /**
     * @return bool
     */
    protected function installDatabase()
    {
        return true;
    }

    /**
     * @return bool
     */
    protected function uninstallDatabase()
    {
        return true;
    }

    /**
     * @param Module $module
     * @param array $hooks
     * @return bool
     */
    protected function registerHooks(Module $module, array $hooks)
    {
        if ($hooks) {
            $hookManager = $this->getHookManager($module, $hooks);
            return $hookManager->registerHooks();
        }

        return true;
    }

    /**
     * @param Module $module
     * @param array $hooks
     * @return HookManagerInterface
     */
    abstract protected function getHookManager($module, $hooks);

    /**
     * @param array $queries
     * @return bool
     */
    protected function executeQueries(array $queries)
    {
        foreach ($queries as $query) {
            if (!Db::getInstance()->execute($query)) {
                return false;
            }
        }

        return true;
    }
}
