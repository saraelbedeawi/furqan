<?php

set_include_path('../');
include_once './helpers/db.php';
include_once "./models/document.php";
/**
 * person.class.php
 * 
 **/
class person {

    public $TableName = "person";
    private $TableId = "id";
    public $id;
    public $name;
    public $birthDate;
    public $nationalId;
    public $gender;
    public $roleId;

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
       if($result)
       { 
           $result = $result->fetch_assoc();
       
       

        $this->id = $result['id'];
        $this->name = $result['name'];
        $this->birthDate = $result['birth_date'];
        $this->nationalId = $result['national_id'];
        $this->gender = $result['gender'];
        $this->roleId = $result['role_id'];

        return $this;
       }
       else
       {
           return false;
       }
    }

    function GetByRoleId($id)
    {
        $conn = db::create_connection();
        $sql = "SELECT * FROM ".$this->TableName." where role_id= $id AND person.isdeleted=0";
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
    function Insert() {
       $person=$this;
        $conn = db::create_connection();
        $sql="INSERT INTO ".$this->TableName." (name,birth_date,national_id,gender,role_id)
            values ('$person->name','$person->birthDate',$person->nationalId,$person->gender,$person->roleId)";
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
        
        $sql="update " .$this->TableName." SET name='$this->name',birth_date='$this->birthDate',national_id=$this->nationalId,
        gender=$this->gender WHERE " .$this->TableId. " = ".$this->id;
        $result = mysqli_query($conn,$sql);
        echo $sql;
    }

    function Delete() 
    {
        $conn = db::create_connection();
        $sql="UPDATE
      person
        INNER JOIN
        `case`
        ON
        person.id = `case`.`child_id`
        INNER JOIN case_details ON `case`.`id`=case_details.case_id INNER JOIN document on case_details.document_id=document.id 
        SET
        person.isdeleted = 1,
        document.isdeleted=1,`case`.isdeleted=1
        WHERE
        person.ID =". $this->id;



        $result = mysqli_query($conn,$sql);
        
    }

    function UpdateChild(document $document)
    {
        $conn = db::create_connection();
        $sql= "UPDATE
        person
        INNER JOIN
        `case`
        ON
        person.id = `case`.`child_id`
        INNER JOIN case_details ON `case`.`id`=case_details.case_id INNER JOIN document on case_details.document_id=document.id 
        SET
        person.name = '$this->name', person.birth_date= '$this->birthDate', person.gender=$this->gender,person.national_id=$this->nationalId,
      
        document.relative='$document->relative',document.station='$document->station',document.district='$document->district',document.report_number=$document->reportNumber,document.report_date='$document->reportDate'
        ,document.decision_number=$document->decisionNumber,document.decision_date='$document->decisionDate', document.state='$document->state'
        WHERE
        person.ID = $this->id";
      $result = mysqli_query($conn,$sql);
    }

    function GetChildDetailsById($id)
    {
        
        $conn = db::create_connection();
        $sql="SELECT  document.relative,document.station,document.district,document.report_number,document.report_date,
        document.decision_number,document.decision_date,document.state,person.name,person.birth_date,person.national_id,person.gender,`case`.id FROM person
        INNER JOIN `case`
        ON person.id = `case`.child_id
        INNER JOIN `case_details` ON `case`.id=`case_details`.`case_id` INNER JOIN document on `case_details`.document_id=document.id where person.id=$id ";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        return $row;
    }

    function deletePerson()
    {
        $conn = db::create_connection();
        $sql="update " .$this->TableName." SET isdeleted=".$this->isdeleted." WHERE ". $this->TableId ."=".$this->id;
        echo $sql;
        $result = mysqli_query($conn,$sql);
    }
}

?>