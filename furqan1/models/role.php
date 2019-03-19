<?php
set_include_path('../');
include_once './helpers/db.php';
class role {

public $TableName = "role";
private $TableId = "parent_id";
public $id;
public $name;
public $parentId;



function GetAll()
{
    $conn = db::create_connection();
    $sql = "SELECT * FROM ".$TableName;
    $result = mysqli_query($conn, $sql);
    $conn->close();

    return $result;
}

    function GetById($parentId) 
 {
    $conn = db::create_connection();
    $sql = "SELECT id,name FROM " .$this->TableName. " WHERE " .$this->TableId. " = ".$parentId;
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result)){
        $return[] = $row;
    }

    $conn->close();

    return $return;
  }
}
?>
