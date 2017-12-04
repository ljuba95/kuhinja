<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 11/11/2017
 * Time: 7:05 PM
 */

define('ROOT_URI', __DIR__ . '/../');
require ROOT_URI . 'config/init.php';
require_once ROOT_URI . 'common/Autoloader.php';
require_once ROOT_URI . 'common/lib/TemplateHelper.php';


use common\Autoloader;
use common\FrontController;

$autoloader = new Autoloader();
$autoloader->register();
session_start();
$frontCtrl = new FrontController();
$frontCtrl->run();