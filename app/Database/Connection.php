<?php

namespace App\Database;

use PDO;
use PDOException;

class Connection
{
    private static $dbName = 'almirWeb';
    private static $dbHost = 'localhost';
    private static $dbUser = 'root';
    private static $dbPassword = 'root';

    private static $cont = null;


    public static function connect()
    {
        if (self::$cont == null) {
            try {
                self::$cont = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,  self::$dbUser, self::$dbPassword);
            } catch (PDOException $exception) {
                die($exception->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
        return self::$cont;
    }
}
