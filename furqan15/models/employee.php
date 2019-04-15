<?php


class employee
{
    public $TableName = "employee";
    public $TableId = "id";
    public $id;
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
    function Insert() {
       
         $conn = db::create_connection();
         $sql="INSERT INTO ".$this->TableName." (person_id,isdeleted)
             values ($this->personId,0)";
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

     function getById($id)
     {
        $conn = db::create_connection();
       $sql="select* from person WHERE person.id =$id";
       $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        return $row;
     }
     function Delete() 
    {
        
            $conn = db::create_connection();
            $sql="update " .$this->TableName." SET isdeleted=".$this->isdeleted." WHERE ". $this->TableId ."=".$this->id;
           echo $sql;
            $result = mysqli_query($conn,$sql);
        
    }
 
        }

?>