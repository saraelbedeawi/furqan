<?php

set_include_path('../');
include_once './helpers/db.php';
include_once "./models/document.php";
/**
 * person.class.php
 * 
 **/
class user {

    public $TableName = "user";
    public $TableId = "id";
    public $id;
    public $username;
    public $password;
    public $personId;
    public $isdeleted=0;
    

    function GetAll()
    {
        $conn = db::create_connection();
        $sql = "SELECT * FROM ".$TableName;
        $result = mysqli_query($conn, $sql);
        $conn->close();

        return $result;
    }

    function GetById($id) 
    {
        $conn = db::create_connection();
        $sql = "SELECT * FROM " .$this->TableName. " WHERE " .$this->TableId. " = ".$id;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $conn->close();
        return $row;
    }

    function Insert() 
    {
        
        $conn = db::create_connection();
        $sql="INSERT INTO ".$this->TableName." (username,password,person_id)
            values ('$this->username','$this->password',$this->personId)";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
            return $conn->insert_id;
        }
        else
        {
            return false;
        }
        $conn->close();
    }

    function Update() 
    {
        $conn = db::create_connection();
        $sql="update " .$this->TableName." SET username='$this->username',password='$this->password' WHERE " .$this->TableId. " = ".$this->id;
        echo($sql);
        $result = mysqli_query($conn,$sql);
    }

    function Delete() 
    {
        $conn = db::create_connection();
        $sql="update " .$this->TableName." SET isdeleted=".$this->isdeleted." WHERE ". $this->TableId ."=".$this->id;
        $result = mysqli_query($conn,$sql);
        echo $sql;
    }
    function login()
    {
        $conn = db::create_connection();
        $sql = "SELECT * FROM `user` WHERE `username`= '$this->username' and `password` =  '$this->password' and isdeleted=0";
        $result = mysqli_query($conn,$sql);
        $row = $result->fetch_assoc();
        
        $this->id = $row['id'];
        $this->username = $row['username'];
        $this->personId = $row['person_id'];
        
        return $this;
        // $personId=$row["person_id"]; 
        
        // $sql="SELECT role_id from person WHERE id = ".$personId;
        // $result1 = mysqli_query($conn, $sql);
        // $rowPerson = $result1->fetch_assoc();
        // $roleId=$rowPerson["role_id"];
        
        
    }

    function GetAcessesPage($roleId)
    {
        $sql="SELECT physical_address from page WHERE page.id 
        =(SELECT page_id from user_access WHERE role_id = $roleId)";
        $result1 = mysqli_query($conn, $sql);
        $physicalAdresses = $result1->fetch_assoc();
    }

    function signOut()
    {
        session_start();
        session_destroy();
       
    }
}

?>