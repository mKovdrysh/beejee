<?php

namespace Masha\Model;

use Masha\Exception\SimpleException;

class Admin extends AbstractModel
{
    const USERNAME = 'admin';
    const PASSWORD = '123';

    /**
     * @param string $username
     * @param string $password
     * @throws SimpleException
     */
    public function login($username, $password)
    {
        if ($username !== self::USERNAME || $password !== self::PASSWORD) {
            throw new SimpleException('Wrong credentials');
        }

        if (!empty($_SESSION['is_logged'])) {
            throw new SimpleException('Already logged');
        }

        $_SESSION['is_logged'] = true;
    }

    public function logout()
    {
        $_SESSION['is_logged'] = false;
    }

    public function isLogged()
    {
        return !empty($_SESSION['is_logged']);
    }
}
