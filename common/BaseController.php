<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 11/19/2017
 * Time: 3:58 PM
 */

namespace common;


class BaseController
{
    function render(string $template, array $params = array()): string
    {
        extract($params);
        ob_start();
        require ROOT_TEMPLATE . $template;
        return ob_get_clean();
    }
}