<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 12/4/2017
 * Time: 11:11 PM
 */

namespace controller;


use common\BaseController;
use common\lib\SessionHelper;
use dao\ReceptDao;
use dao\UserDao;
use model\User;

class UsersController extends BaseController
{

    public function newAction()
    {
        $user = SessionHelper::loggedUser();
        if (!is_null($user)) {
            echo $this->render('global/main.php', array('content' => ''));
        } else {
            echo $this->render('sessions/register.php');
        }

    }

    public function createAction()
    {
        if(!isset($_POST['email'])){
            SessionHelper::setFlashMessage('danger','Greška.');
            echo $this->render('sessions/register.php');
            return;
        }
        $dao = new UserDao();
        $user = $dao->loadByEmail($_POST['email']);
        if(!is_null($user)){
            SessionHelper::setFlashMessage('danger','Korisnik sa email-om ' . $_POST['email'] . 'već postoji!');
            echo $this->render('sessions/register.php');
            return;
        }

        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setName($_POST['name']);
        $user->setPassword($_POST['password']);

        if($dao->save($user)){
            SessionHelper::setFlashMessage('success', 'Dobrodošao/la ' . $user->getName() . '. Uspešno ste se registrovali.');
            $user = $dao->loadByEmail($user->getEmail());
            SessionHelper::loginUser($user);
            echo $this->render('global/main.php',['content' => '']);
        }else{
            SessionHelper::setFlashMessage('danger','Neuspešna registracija.');
            echo $this->render('sessions/register.php');
            return;
        }

    }

    public function receptiAction($id){
        $user = SessionHelper::loggedUser();
        if($user->getId() != $id){
            $this->newAction();
            return;
        }

        $dao = new ReceptDao();
        $recepti = $dao->loadByUser($id);

        echo $this->render('user/recipes.php',['recepti' => $recepti]);


    }
}