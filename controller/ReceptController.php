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
use dao\UserDao;
use model\Recept;

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

        $userDao = new UserDao();

        foreach ($recepti as $recept){
            $recept->userName = $userDao->loadById($recept->getUserId())->getName();
        }

        echo $this->render('recipe/index.php', array('recepti' => $recepti, 'page' => $page, 'page' => $page, 'pages' => $pages, 'uri' => $uri));
    }

    public function showAction(int $id){
        $dao = new ReceptDao();
        $recept = $dao->loadById($id);
        $userDao = new UserDao();
        $recept->userName = $userDao->loadById($recept->getUserId())->getName();
        echo $this->render('recipe/show.php', array('recept' => $recept));
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

    public function createAction()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->insertAction();
            return;
        }

        $user = SessionHelper::loggedUser();
        if (is_null($user)) {
            SessionHelper::setFlashMessage('info', 'Morate biti ulogovani da bi postavili novi recept.');
            echo $this->render('global/main.php', array('content' => ''));
            return;
        }
        
        $recept = new Recept();
        $img = new ImageHelper($_FILES['img']);
        if ($img->uploaded) {
            $img->file_new_name_body = explode('.', $_FILES['img']['name'])[0] . '_resized';
            $img->image_resize = true;
            $img->image_x = 900;
            $img->image_ratio_y = true;
            $img->process('./storage');
            if ($img->processed) {
                $img->clean();

                $recept->setName($_POST['name']);
                $recept->setUserId($user->getId());
                $recept->setImg(ltrim($img->file_dst_pathname, '.'));
                $recept->setDateCreated(date('Y-m-d', time()));
                $recept->setTimeNeeded($_POST['timeNeeded']);
                $recept->setText($_POST['text']);
                $dao = new ReceptDao();

                if ($dao->save($recept)) {
                    SessionHelper::setFlashMessage('success', 'Uspešno ste dodali novi recept.');
                    $this->indexAction();
                    return;
                } else {
                    SessionHelper::setFlashMessage('danger', 'Došlo je do greške prilikom čuvanja recepta.');
                    $this->insertAction();
                    return;
                }

            } else {
                SessionHelper::setFlashMessage('danger', 'Došlo je do greške prilikom čuvanja slike.');
                $this->insertAction();
                return;
            }
        }

    }

    public function editAction(int $id){
        $user = SessionHelper::loggedUser();
        $dao = new ReceptDao();
        $recept = $dao->loadById($id);

        if(is_null($recept)){
            return;
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            echo $this->render('recipe/edit.php', ['recept' => $recept]);
        }else if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(!empty($_FILES['img']['name'])){
                $img = new ImageHelper($_FILES['img']);
                if ($img->uploaded) {
                    $img->file_new_name_body = explode('.', $_FILES['img']['name'])[0] . '_resized';
                    $img->image_resize = true;
                    $img->image_x = 900;
                    $img->image_ratio_y = true;
                    $img->process('./storage');
                    if ($img->processed) {
                        $img->clean();
                        $recept->setImg(ltrim($img->file_dst_pathname, '.'));
                    } else {
                        SessionHelper::setFlashMessage('danger', 'Došlo je do greške prilikom čuvanja slike.');
                        $this->insertAction();
                        return;
                    }
                }
            }

            $recept->setName($_POST['name']);
            $recept->setDateCreated(date('Y-m-d', time()));
            $recept->setTimeNeeded($_POST['timeNeeded']);
            $recept->setText($_POST['text']);

            if ($dao->update($recept)) {
                SessionHelper::setFlashMessage('success', 'Uspešno ste izmenili recept.');
                $this->showAction($id);
                return;
            } else {
                SessionHelper::setFlashMessage('danger', 'Došlo je do greške prilikom izmene recepta.');
                $this->insertAction();
                return;
            }

        }

    }

    public function deleteAction(int $id){
        $user = SessionHelper::loggedUser();
        $dao = new ReceptDao();
        $recept = $dao->loadById($id);

        if($user->getId() != $recept->getUserId()){
            SessionHelper::setFlashMessage('danger', 'Došlo je do greške prilikom brisanja recepta.');
            $this->insertAction();
            return;
        }

        if($dao->delete($id)){
            SessionHelper::setFlashMessage('success', 'Uspešno ste obrisali recept.');
        }else{
            SessionHelper::setFlashMessage('danger', 'Došlo je do greške prilikom brisanja recepta.');
        }
        $this->insertAction();
    }



}