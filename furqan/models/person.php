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
        $sql = "SELECT * FROM ".$TableName;
        $result = mysqli_query($conn, $sql);
        $conn->close();

        return $result;
    }

    function GetById($id) {
        $conn = db::create_connection();
        $sql = "SELECT * FROM " .$TableName. " WHERE " .$TableId. " = ".$id;
        $result = mysqli_query($conn, $sql);
        $conn->close();

        return $result;
    }

    function Insert() {
        $person = $this;
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

    function Update(person $person) 
    {
        $conn = db::create_connection();
        $sql="update into".$TableName."(name,birth_date,national_id,gender,role_id)
        values ('$person->name','$person->birthDate',$person->nationalId,$person->gender,$person->roleId) WHERE " .$TableId. " = ".$person->id;
        $result = mysqli_query($conn,$sql);
    }

    function Delete() 
    {
        $conn = db::create_connection();
        $sql="DELETE from".$this->TableName." where id = $this->id";
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



}

?>