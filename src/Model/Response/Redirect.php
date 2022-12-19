<?php

namespace BelVG\ModuleCore\Model\Response;

use BelVG\ModuleCore\Api\Response\ResponseInterface;
use Tools;

class Redirect implements ResponseInterface
{
    /**
     * Admin panel scope
     */
    const ADMIN_SCOPE = 'admin';

    /**
     * Frontend scope
     */
    const FRONT_SCOPE = 'front';

    /**
     * @var string
     */
    protected $scope;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param array $params
     * @param string|null $scope
     */
    public function __construct($params = [], $scope = null)
    {

        $this->params = $params;
        $this->scope = $scope !== null ? $scope : self::FRONT_SCOPE;
    }

    /**
     * @inheritDoc
     */
    public function process()
    {
        if ($this->scope === self::ADMIN_SCOPE) {
            $this->redirectAdmin();
        }
    }

    /**
     * @param array $params
     * @return ResponseInterface
     */
    public function setParams($params)
    {
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    /**
     * @return string
     */
    protected function generateParamsString()
    {
        $paramsString = '';

        foreach ($this->params as $key => $value) {
            $paramsString .= '&' . $key;
            if ($value !== '') {
                $paramsString .= '=' . $value;
            }
        }

        if ($this->scope === self::ADMIN_SCOPE && isset($this->params['controller'])) {
            $paramsString .= '&token=' . $this->getAdminTokenLite($this->params['controller']);
        }

        if (!empty($paramsString)) {
            $paramsString = '?' . $paramsString;
        }

        return $paramsString;
    }

    /**
     * ToDo: Add default token handling
     * @param string $controller
     */
    private function getAdminTokenLite($controller)
    {
        switch ($controller) {
            case 'AdminProducts':
                $token = Tools::getAdminTokenLite('AdminProducts');
                break;
            default:
                $token = '';
        }
        return $token;
    }

    /**
     * @return void
     */
    protected function redirectAdmin()
    {
        $url = 'index.php' . $this->generateParamsString();
        Tools::redirectAdmin($url);
    }
}
