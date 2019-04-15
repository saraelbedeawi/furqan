<?php

set_include_path('../');
include_once './helpers/db.php';

class receipt {

    private $TableName = "receipt";
    private $TableId = "id";
    public $userId;
    public $amount;
    public $donorId;
    public $donationTypeId;
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
        $sql="INSERT INTO ".$this->TableName." (`user_id`, `amount`, `donor_id`,
        `isdeleted`, `donation_type_id`) values (1,$this->amount,$this->donorId,this->isdeleted, $this->donationTypeId)";
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

//     function Update(child $child) 
//     {
//         $conn = db::create_connection();
//         $child->updatedAt= date('Y-d-m H:i:s',time());
//         $sql="update into".$TableName."(updated_at)
//         values ('$child->updatedAt') WHERE " .$TableId. " = ".$child->id;
//         $result = mysqli_query($conn,$sql);
//     }

//     function Delete($id) 
//     {
//         $conn = db::create_connection();
//         $sql="Update ".$TableName." SET isdeleted=1 where id =" .$id;
//         $result = mysqli_query($conn,$sql);
//     }
}

?>