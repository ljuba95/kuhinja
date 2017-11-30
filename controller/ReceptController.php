<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 11/30/2017
 * Time: 9:41 PM
 */

namespace controller;


use common\BaseController;
use common\lib\SessionHelper;
use dao\ReceptDao;

class ReceptController extends BaseController
{


    public function indexAction(int $page = 1)
    {
        $dao = new ReceptDao();
        $numberOfPages = ceil($dao->count() / DEFAULT_ROWNUMBER);

        if ($page < 1 || $page > $numberOfPages) {
            $page = 1;
        }

        $pages = $this->getPagination($page, $numberOfPages);


        $uri = '/recept/index/{$page}/';
        $recepti = $dao->loadPage($page);

        SessionHelper::setFlashMessage('success','yaaaaaaay');


        echo $this->render('recipe/index.php', array('recepti' => $recepti, 'page' => $page, 'page' => $page, 'pages' => $pages, 'uri' => $uri));
    }

    public function showAction(int $id){
        $dao = new ReceptDao();
        $recept = $dao->loadById($id);
        $this->dd($recept);
    }
}