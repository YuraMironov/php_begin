<?php 

namespace Core;

class PDBC
{
	public static $connection = null;
	public static function getConnection()
    {
        $connection = null;
        try {
            if ($connection === null) {
                $connection = new \PDO("mysql:host=localhost;dbname=php_pro", "php-pro-web-master", "123456");
            }
        } catch (PDOException $e) {
            echo 'Подключение к базе данных не удалось: ' . $e->getMessage();
        }
        return $connection;
    }
}