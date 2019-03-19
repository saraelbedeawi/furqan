
<?php

set_include_path('../');
include_once './helpers/db.php';
class optionsTypes {

private $TableName = "options_types";
private $TableId = "id";
public $name;


function GetAll() 
{
    $conn = db::create_connection();
    $sql = "SELECT * FROM ".$this->TableName;
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result))
    {
        $return[] = $row;
    }
    if (empty($return))
    {
       return false;
    }
   
    else
    {
        return $return;
    }
     $conn->close();
    }
}
?>