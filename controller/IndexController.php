<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 11/19/2017
 * Time: 3:53 PM
 */
namespace controller;

use common\BaseController;

class IndexController extends BaseController
{
    public function indexAction()
    {
        echo $this->render('global/main.php', array('content' => ''));
    }
}