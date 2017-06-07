<?php

namespace Masha\Model;

class Connection
{
    /**
     * @var \PDO
     */
    private static $connection;

    /**
     * Connection constructor.
     */
    private function __construct() {}

    /**
     * Connection clone.
     */
    private function __clone() {}

    /**
     * @return \PDO
     */

    public static function getConnection() {
        if (!static::$connection) {
            $config = require_once BP . 'configs/db.php';

            static::$connection = new \PDO(
                'mysql:host=localhost;dbname=beegee',
                $config['user'],
                $config['password']
            );
        }

        return static::$connection;
    }
}
