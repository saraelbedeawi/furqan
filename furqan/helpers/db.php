<?php

class db {
    static private $ServerName = "localhost";
    static private $DBUsername = "root";
    static private $DBPassword = "";
    static private $DBName= "dar_elfourkan";

    function create_connection() {
        $conn = new mysqli(self::$ServerName, self::$DBUsername, self::$DBPassword, self::$DBName);
        mysqli_query($conn,"SET NAMES 'utf8'"); 
        mysqli_query($conn,'SET CHARACTER SET utf8');
        return $conn;
    }
}

?>