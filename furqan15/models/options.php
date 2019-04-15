<?php

set_include_path('../');
include_once './helpers/db.php';
class options {

private $TableName = "options";
private $TableId = "id";
public $id;
public $name;
public $optionTypeId;



function GetAll()
{
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
    $sql="INSERT INTO ".$this->TableName." (`name`,option_type_id) 
    values ('$this->name',$this->optionTypeId)";
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
}
?>