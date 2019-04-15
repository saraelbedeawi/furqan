<?php

set_include_path('../');
include_once './helpers/db.php';

class document {

    private $TableName ="document";
    private $TableId = "id";
    public $id;
    public $relative;
    public $station;
    public $district;
    public $reportNumber;
    public $reportDate;
    public $decisionNumber;
    public $decisionDate;
    public $state;

    

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
        $document = $this;
        $conn = db::create_connection();
        $sql="INSERT INTO ".$this->TableName."(`relative`, `station`, `district`, `report_number`,
        `report_date`, `decision_number`, `decision_date`,`state`)
            values ('$document->relative','$document->station','$document->district',$document->reportNumber
            ,'$document->reportDate',$document->decisionNumber,'$document->decisionDate','$document->state')";
        echo $sql;
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
function InsertCaseDetails($caseId,$document_id)
{
    $conn = db::create_connection();
    $sql="insert into case_details(case_id,document_id) values ($caseId, $document_id)";
    $result = mysqli_query($conn,$sql);
}
    function Update(document $document) 
    {
        $conn = db::create_connection();
        $sql="update into".$TableName."(`relative`, `station`, `district`, `report_number`,
        `report_date`, `decision_number`, `decision_date`,`state`)
            values ('$document->relative','$document->station','$document->district',$document->reportNumber
            ,'$document->reportDate',$document->decisionNumber,'$document->decisionDate','$document->state') WHERE " .$TableId. " = ".$document->id;
        $result = mysqli_query($conn,$sql);
    }

    function Delete($id) 
    {
        $conn = db::create_connection();
        $sql="DELETE from".$TableName." where id = $id";
        $result = mysqli_query($conn,$sql);
    }
}

?>