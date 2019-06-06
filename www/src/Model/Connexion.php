<?php

namespace App\Model;

    class Connexion {
        
    public static function connectPDO(){
        $pdo = new \PDO("mysql:host=".getenv('MYSQL_HOST')."; dbname=".
            getenv('MYSQL_DATABASE'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
        return $pdo;
}





}