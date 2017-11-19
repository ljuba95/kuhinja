<?php

/**
 * @param string $template
 * @param array $params
 * @return string Result of rendered template
 */
function render(string $template, array $params = array()): string
{
    extract($params);
    ob_start();
    require ROOT_TEMPLATE . $template;
    return ob_get_clean();
}