<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PDO;
class Database extends Model
{
    protected static PDO $pdo;

    public static function getPDO(){
        if(!isset(self::$pdo)){
            self::$pdo = new PDO('pgsql:host=postgres;port=5432;dbname=laravel', 'root', 'root');
        }
        return self::$pdo;
    }
}
