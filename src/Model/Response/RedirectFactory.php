<?php

namespace BelVG\ModuleCore\Model\Response;

class RedirectFactory
{
    /**
     * @param array $params
     * @param string|null $scope
     * @return Redirect
     */
    public static function create($params = [], $scope = null)
    {
        return new Redirect($params, $scope);
    }
}
