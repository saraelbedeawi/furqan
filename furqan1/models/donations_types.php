<?php

set_include_path('../');
include_once './helpers/db.php';
class donationsTypes {

private $TableName = "donation_types";
private $TableId = "id";
public $id;
public $name;
public $isdeleted=0;

function GetAll() {
    $conn = db::create_connection();
    $sql = "SELECT * FROM ".$this->TableName."and isdeleted=0";
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
    $sql="INSERT INTO ".$this->TableName." (`name`,isdeleted) values ('$this->name',$this->isdeleted)";
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

function getDonationOptionDetails($id)
{
    $conn = db::create_connection();
    $sql="SELECT donation_types.id,donation_types.name,options.id as optionId,options.name as optionsName,options_types.type FROM donation_types INNER JOIN donation_options  on donation_types.id=donation_options.donation_types_id INNER JOIN options on options.id=donation_options.options_id INNER join options_types on options.option_type_id = options_types.id WHERE donation_options.donation_types_id=$id And donation_options.isdeleted=0";
    $result = mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_assoc($result))
    {
        $return[] = $row;
    }
    if (empty($return))
    {
       return false;
    }
    $conn->close();

    return $return;
}
function UPDATE()
{
    $conn = db::create_connection();
    $sql="UPDATE".$this->TableName." SET name='$this->name' where id =".$this->id;
    $result = mysqli_query($conn,$sql);
    echo $sql;
    $conn->close();
}
function Delete()
{
    $conn = db::create_connection();
    $sql="UPDATE " .$this->TableName." SET isdeleted=1 where id =".$this->id;
    $result = mysqli_query($conn,$sql);
    echo $sql;
    $conn->close();
}


}
?>