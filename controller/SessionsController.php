<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 12/4/2017
 * Time: 10:07 PM
 */

namespace controller;


use common\BaseController;
use common\lib\SessionHelper;
use dao\UserDao;

class SessionsController extends BaseController
{


    public function newAction()
    {
        $user = SessionHelper::loggedUser();
        if (!is_null($user)) {
            SessionHelper::setFlashMessage('info', 'Dragi/a ' . $user->getName() . ' već ste ulogovani.');
            echo $this->render('global/main.php', array('content' => ''));
        } else {
            echo $this->render('sessions/signin.php');
        }
    }

    public function createAction(){
        $user = SessionHelper::loggedUser();
        if (!is_null($user)) {
            SessionHelper::setFlashMessage('info',$user->getName() . ', već ste ulogovani.');
            echo $this->render('global/main.php', array('content' => ''));
        } else {
            $dao = new UserDao();
            $user = $dao->loadByEmail($_POST['email']);
            if(is_null($user)){
                SessionHelper::setFlashMessage('warning','Korisnik sa email-om ' . $_POST['email'] . ' ne postoji.');
                echo $this->render('sessions/signin.php');
                return;
            }

            if($user->getPassword() == md5($_POST['password'])){
                SessionHelper::setFlashMessage('success', 'Dobrodošao/la ' . $user->getName() . '.');
                SessionHelper::loginUser($user);
                echo $this->render('global/main.php',['content' => '']);
            }else{
                SessionHelper::setFlashMessage('danger', 'Uneta je pogrešna šifra. Pokušajte ponovo.');
                echo $this->render('sessions/signin.php');
                return;
            }
        }
    }

    public function destroyAction()
    {
        if(!is_null(SessionHelper::loggedUser())) {
            session_unset();
            session_destroy();
            SessionHelper::setFlashMessage('success', 'Uspešno ste se odjavili.');

        }
        echo $this->render('global/main.php',array('content' => ''));
    }
}