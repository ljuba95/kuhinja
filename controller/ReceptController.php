<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 11/30/2017
 * Time: 9:41 PM
 */

namespace controller;


use common\BaseController;
use common\lib\ImageHelper;
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

        //SessionHelper::setFlashMessage('success','yaaaaaaay');


        echo $this->render('recipe/index.php', array('recepti' => $recepti, 'page' => $page, 'page' => $page, 'pages' => $pages, 'uri' => $uri));
    }

    public function showAction(int $id){
        $dao = new ReceptDao();
        $recept = $dao->loadById($id);

        echo $this->render('recipe/show.php', array('recept' => $recept));
//        $dao = new UserDao();
//        $user = $dao->loadById($recept->getUserId());
//        echo $this->render('recipe/show.php', array('recept' => $recept, 'user' => $user));
    }

    public function insertAction(){
        $user = SessionHelper::loggedUser();
        if(is_null($user)){
            SessionHelper::setFlashMessage('info','Morate biti ulogovani da bi postavili novi recept.');
            echo $this->render('global/main.php', array('content' => ''));
        }else{
            echo $this->render('recipe/insert.php');
        }
    }

    public function createAction(){
        $user = SessionHelper::loggedUser();
        $img = new ImageHelper($_FILES['img']);
        if($img->uploaded){
            $img->image_resize         = true;
            $img->image_x              = 900;
            $img->image_ratio_y        = true;
            $img->process('/var/www/elab/Recepti/storage');
            if ($img->processed) {
                echo 'image resized';
                echo $img->file_dst_pathname;
                //todo: rip
                $img->clean();
            }
        }


    }
}