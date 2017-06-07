<?php

namespace Masha\Controller;

use Masha\Model\Admin;

class AdminController extends AbstractController
{
    public function loginAction()
    {
        $this->getSmarty()->display('login.tpl');
    }

    public function loginPostAction()
    {
        $admin = new Admin();

        $admin->login(
            !empty($_POST['username']) ? $_POST['username'] : '',
            !empty($_POST['password']) ? $_POST['password'] : ''
        );

        $this->redirect('/');
    }

    public function logoutAction() {
        $admin = new Admin();
        $admin->logout();

        $this->redirect('/');
    }
}
