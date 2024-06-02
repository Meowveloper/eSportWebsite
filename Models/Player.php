<?php

namespace Models;
use mysqli;
class Database
{

    private static $host = "localhost";
    private static $user = "root";

    private static $password = "";

    private static $db = "esport_database";

    private static $connection;



    public static function getConnection ()
    {
        if(!self::$connection) {
            self::$connection = new mysqli(self::$host, self::$user, self::$password, self::$db);
            
            if(self::$connection->connect_error) die("connection failed");
        }
        return self::$connection;
    }
}

class Model 
{
    protected $connection;

    public function __construct()
    {
        
        $this->connection = Database::getConnection();

    }

}


class Player extends Model
{
    private static $table = 'tbl_player';

    public function get() 
    {
        $connection = $this->connection;
        

        $query = "SELECT * FROM ". self::$table;
        $result = $connection->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

}

$result = new Player();

$result = $result->get();
