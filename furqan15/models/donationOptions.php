<?php

set_include_path('../');
include_once './helpers/db.php';
class donationOptions {

private $TableName = "donation_options";
private $TableId = "id";
public $donationTypesId;
public $optionId;
public $isdeleted=0;

function GetAll() {
    $conn = db::create_connection();
    $sql = "SELECT * FROM ".$this->TableName;
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $return[] = $row;
    }
    if (empty($return))
    {
       return false;
    }
   
    else
    {
        return $return;
    } $conn->close();

 
}


function Insert()
    {
    $conn = db::create_connection();
    $sql="INSERT INTO ".$this->TableName." (`donation_types_id`,options_id,isdeleted) 
    values ($this->donationTypeId,$this->optionId,$this->isdeleted)";
    $result = mysqli_query($conn,$sql);
    echo $sql;
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

function deleteRelations()
{
    $conn = db::create_connection();
    $sql="UPDATE donation_options SET isdeleted=1 where donation_types_id =$this->donationTypesId";
    $result = mysqli_query($conn,$sql);
    echo $sql;
    $conn->close();
}
}