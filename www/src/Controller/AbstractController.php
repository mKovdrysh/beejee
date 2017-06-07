<?php

namespace Masha\Controller;

use Masha\Model\Admin;

class AbstractController
{
    /**
     * @var \Smarty
     */
    private $smarty;

    public function __construct()
    {
        $this->smarty = new \Smarty();
        $this->smarty->caching = false;

        $this->smarty->assign([
            'isAdmin' => $this->isLogged(),
            'message' => $this->getSessionMessage()
        ]);
    }

    /**
     * @return \Smarty
     */

    protected function getSmarty()
    {
        return $this->smarty;
    }

    /**
     * @param string $url
     * @param string $message
     */
    public function redirect($url, $message = null)
    {
        if ($message) {
            $_SESSION['message'] = $message;
        }

        header("Location: " . $url);

        exit();
    }

    /**
     * @return string
     */
    private function getSessionMessage()
    {
        $message = !empty($_SESSION['message']) ? $_SESSION['message'] : null;

        if (!empty($_SESSION['message'])) {
            unset($_SESSION['message']);
        }

        return $message;
    }


    private function isLogged()
    {
       $admin = new Admin();
       return $admin->isLogged();
    }
}
