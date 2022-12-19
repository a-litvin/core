<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__.'/vendor/autoload.php';

class BelVGModuleCore extends Module
{
    /**
     * BelVGFramework constructor
     */
    public function __construct()
    {
        $this->name = 'belvgmodulecore';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'BelVG';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('BelVG Framework');
        $this->description = $this->l('BelVG Framework.');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.6.1.24');
    }
}
