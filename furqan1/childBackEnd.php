<?php
include_once "./models/person.php";
include_once "./models/child.php";
include_once "./models/document.php";
include_once "./helpers/ViewHelper.php";
if(isset($_POST['method']) && $_POST['method']=="addChild")
{
    addChild();
}
else if(isset($_GET['method']) && $_GET['method']=="showUpdate")
{
    viewUpdate();
}
else if(isset($_POST['method']) && $_POST['method']=="deleteChild")
{
    deleteChild();
}
else if(isset($_POST['method']) && $_POST['method']=="editChild")
{
    updateChild();
}
else if(isset($_GET['method']) && $_GET['method']=="getChilderen")
{
    
    Getchilderen();
}

else if(isset($_GET['method']) && $_GET['method']=="vievAddChild")
{
    View('addChild.html');
}
else
{
    View('editChild.html');
}

function addChild()
 {
    

   
    $person = new person();
    $person->name=$_POST['name'];
    $person->birthDate=$_POST['DOB'];
    $person->nationalId=$_POST['SSN'];
    $person->gender=$_POST['gender'];
    $person->roleId=6;
    $personId = $person->Insert();
 
    $child= new child();
    $child->supervisorId=18;
    $child->childId=$personId;
    $caseId = $child->Insert();

    $document = new document();
    $document->relative= $_POST['nasab'];
    $document->state= $_POST['state'];
    $document->station= $_POST['station'];
    $document->district= $_POST['district'];
    $document->reportNumber= $_POST['reportNum'];
    $document->reportDate= $_POST['reportDate'];
    $document->decisionNumber= $_POST['decisionNum'];
    $document->decisionDate= $_POST['decisionDate'];
    $document_id = $document->Insert();
    $document->InsertCaseDetails($caseId, $document_id);
 

 }

 function viewUpdate()
{
    $id=$_GET['id'];
    $childDetails=new person();
    $row = $childDetails->GetChildDetailsById($id);
    $relative=$row['relative'];
     $station=$row['station'];
     $district=$row['district'];
     $report_num=$row['report_number'];
     $report_date=$row['report_date'];
     $decision_number=$row['decision_number'];
     $decision_date=$row['decision_date'];
     $state=$row['state'];
     $name=$row['name'];
     $DOB=$row['birth_date'];
     $SSN=$row['national_id'];
     $gender=$row['gender'];


     $replacement_array = array(
        'name' => $name,
        'DOB'=>$DOB,
        'relative'=>$relative,
        'SSN'=>$SSN,
        'state'=>$state,
        'station'=>$station,
        'district'=>$district,
        'report_num'=>$report_num,
        'report_date'=>$report_date,
        'decision_number'=>$decision_number,
        'decision_date'=>$decision_date,);
        echo json_encode($replacement_array);
}
function updateChild()
{   
    $person = new person();
    $person->name=$_POST['name'];
    $person->birthDate=$_POST['DOB'];
    $person->nationalId=$_POST['SSN'];
    $person->gender=$_POST['gender'];
    $person->id=$_POST['id'];

    $document = new document();
    $document->relative= $_POST['nasab'];
    $document->state= $_POST['state'];
    $document->station= $_POST['station'];
    $document->district= $_POST['district'];
    $document->reportNumber= $_POST['reportNum'];
    $document->reportDate= $_POST['reportDate'];
    $document->decisionNumber= $_POST['decisionNum'];
    $document->decisionDate= $_POST['decisionDate'];
    $person->updateChild($document);
}
 function deleteChild()
 {
    $person = new person();
    $person->id=$_POST['id'];
    $person->Delete();
    //     $sql= "SELECT  case_details.document_id from `case` INNER JOIN case_details on `case`.id=
    //      case_details.case_id where `case`.child_id = $id";
    //     $result = mysqli_query($conn,$sql);
    //     $row=mysqli_fetch_row($result);
    //     $document_id=$row['document_id'];

    //    $sql= "DELETE from document where id = $document_id";
    //    echo $sql;
    //     $result = mysqli_query($conn,$sql);

        // $sql= "DELETE from person where id = $id";
        // $result = mysqli_query($conn,$sql);

    
 }
 function Getchilderen()
 {

     $person=new person();
     $arr=array();
     $rows=$person->GetByRoleId(6);
     foreach ( $rows as $row )  
     { 
        $person=new person();
        $person->id = $row['id'];
        $person->name = $row['name'];
        $person->birthDate = $row['birth_date'];
        $person->nationalId = $row['national_id'];
        $person->gender = $row['gender'];
        $person->roleId = $row['role_id'];
         array_push( $arr, $person );  
     } 
     
    echo json_encode($arr);

 }
 function View($file)
 {
    ViewHelper::parser('header.html');
    ViewHelper::parser($file);
 }
 

?>