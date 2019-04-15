<?php

set_include_path('../');
include_once './helpers/db.php';
class donor 
{

    private $TableName = "donor";
    private $TableId = "id";
    public $name;
    public $phoneNumber;
    public $SSN;
    public $updatedAt;
    public $isdeleted =0;


    function GetAll() {
        $conn = db::create_connection();
        $sql = "SELECT * FROM ".$this->TableName;
        $result = mysqli_query($conn, $sql);
        $conn->close();
        return $result;
    }

    function GetById($id) {
        $conn = db::create_connection();
        $sql = "SELECT * FROM " .$this->TableName. " WHERE " .$this->TableId. " = ".$id;
        $result = mysqli_query($conn, $sql);
        $conn->close();

        return $result;
    }

    function Insert() {
        
        $conn = db::create_connection();
        $sql="INSERT INTO ".$this->TableName." (`name`, `phone_number`, `SSN`,
        `isdeleted`) values ('$this->name',$this->phoneNumber,$this->SSN,this->isdeleted)";
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
}
    ?>