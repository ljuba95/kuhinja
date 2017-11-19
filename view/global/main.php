<?php

$menu = render('menu/menu.php');
$alertMessages = render('global/alert-messages.php');
$content = $alertMessages . $content;

echo render('base.php', array_merge($params, array('content' => $content, 'menu' => $menu)));
