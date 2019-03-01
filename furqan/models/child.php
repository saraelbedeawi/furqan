<?php

set_include_path('../');
include_once './helpers/db.php';

class child {

    private $TableName = "`case`";
    private $TableId = "id";
    public $id;
    public $createdAt;
    public $supervisorId;
    public $childId;

    function GetAll() {
        $conn = db::create_connection();
        $sql = "SELECT * FROM ".$TableName;
        $result = mysqli_query($conn, $sql);
        $conn->close();

        return $result;
    }

    function GetById($id) {
        $conn = db::create_connection();
        $sql = "SELECT * FROM " .$this->TableName. " WHERE " .$TableId. " = ".$id;
        $result = mysqli_query($conn, $sql);
        $conn->close();

        return $result;
    }

    function Insert() {
        $child = $this;
        $conn = db::create_connection();
        $sql="INSERT INTO ".$this->TableName." (supervisor_id,child_id)
            values ('$child->supervisorId',$child->childId)";
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

    function Update(child $child) 
    {
        $conn = db::create_connection();
        $sql="update into".$TableName."(name,birth_date,national_id,gender,role_id)
        values ('$child->createdAt','$child->supervisorId',$child->childId) WHERE " .$TableId. " = ".$child->id;
        $result = mysqli_query($conn,$sql);
    }

    function Delete($id) 
    {
        $conn = db::create_connection();
        $sql="DELETE from".$TableName." where id = $id";
        $result = mysqli_query($conn,$sql);
    }
}

?>