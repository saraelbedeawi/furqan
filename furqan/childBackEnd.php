<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname= "dar_elfourkan";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

include_once "./models/person.php";
include_once "./models/child.php";
include_once "./models/document.php";
if(isset($_POST['method']) && $_POST['method']=="addChild")
{
    addChild($conn);
}
if(isset($_GET['method']) && $_GET['method']=="showUpdate")
{
    viewUpdate($conn);
}
if(isset($_POST['method']) && $_POST['method']=="deleteChild")
{
    deleteChild($conn);
}


if(isset($_POST['method']) && $_POST['method']=="editChild")
{
    updateChild($conn);
}
function addChild($conn)
 {
    

    mysqli_query($conn,"SET NAMES 'utf8'"); 
    mysqli_query($conn,'SET CHARACTER SET utf8');
    $person = new person();
    $person->name=$_POST['name'];
    $person->birthDate=$_POST['DOB'];
    $person->nationalId=$_POST['SSN'];
    $person->gender=$_POST['gender'];
    $person->roleId=6;
    $personId = $person->Insert();
 
    $child= new child();
    $child->supervisorId=6;
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
    $sql="insert into case_details(case_id,document_id) values ($caseId, $document_id)";
    $result = mysqli_query($conn,$sql);

 }
function viewUpdate($conn)
{
    $id=$_GET['id'];
    mysqli_query($conn,"SET NAMES 'utf8'"); 
    mysqli_query($conn,'SET CHARACTER SET utf8');
    $sql="SELECT  document.relative,document.station,document.district,document.report_number,document.report_date,
    document.decision_number,document.decision_date,document.state,person.name,person.birth_date,person.national_id,person.gender,`case`.id FROM person
    INNER JOIN `case`
    ON person.id = `case`.child_id
    INNER JOIN `case_details` ON `case`.id=`case_details`.`case_id` INNER JOIN document on `case_details`.document_id=document.id where person.id=$id";
 $result = mysqli_query($conn,$sql);
 
 $row = mysqli_fetch_array($result);
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


 echo'<form class="col-md-6 offset-md-3" id="add_child_form">
 <div class="row">
     <div class="col-md-6">
         <label for="nameInput">الاسم</label>
         <input type="text" id="name" class="form-control" value="'.$name.'" "placeholder="الاسم"><br>
     </div
     <div class="col-md-6">
         <label for="nameInput">تاريخ الميلاد</label>
         <input type="date" id="DOB" value="'.$DOB.'" class="form-control"><br>
     </div>
 </div>
 
 <div class="row">
     <div class="col-md-3 offset-md-3">
         <div class="form-check">
             <input value="0" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
             <label class="form-check-label" for="exampleRadios1">
                 ذكر
             </label>
         </div>
     </div>
     <div class="col-md-3">
         <div class="form-check">
             <input value="1"class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
             <label  class="form-check-label" for="exampleRadios1">
                 انثي
             </label>
         </div>
     </div>
 </div>
 
 <div class="row">
     <div class="col-md-6">
         <label>النسب</label>
         <input id="nasab" type="text" value="'.$relative.'" class="form-control" >
     </div>
     <div class="col-md-6">
         <label>الرقم القومي</label>
         <input id="SSN" type="text" value="'.$SSN.'" class="form-control">
     </div>
     <div class="col-md-6">
         <label>محافظه العثور</label>
         <input id="state" type="text"value="'.$state.'" class="form-control">
     </div>
     <div class="col-md-6">
         <label>قسم / مركز</label>
         <input id="station" type="text" value="'.$station.'" class="form-control">
     </div>
     <div class="col-md-6">
         <label>حي / شياخه</label>
         <input id="district" type="text" value="'.$district.'" class="form-control">
     </div>
     <div class="col-md-6">
         <label>رقم المحضر</label>
         <input id="Record-num" value="'.$report_num.'" type="text" class="form-control">
     </div>
     <div class="col-md-6">
         <label>تاريخ المحضر</label>
         <input id="Record-date"  value="'.$report_date.'"type="date" class="form-control">
     </div>
     <div class="col-md-6">
         <label>رقم قرار النيابه</label>
         <input id="decision-num" value="'.$decision_number.'" type="text" class="form-control">
     </div>
     <div class="col-md-6">
         <label>تاريخ قرار النيابه</label>
         <input  value="'.$decision_date.'"id="decision-date"type="date" class="form-control">
     </div>
     <div class="col-md-4 offset-md-2">
         <button style="margin-top:20px;color: orange;
         "class="btn btn-light" onclick="UpdateChild('.$id.', event)">حفظ</button>
     </div>		
 </div>				
    </form>';
}
function updateChild($conn)
{   
    $person = new person();
    $person->name=$_POST['name'];
    $person->birthDate=$_POST['DOB'];
    $person->nationalId=$_POST['SSN'];
    $person->gender=$_POST['gender'];
    $person->id=$_POST['id'];
    mysqli_query($conn,"SET NAMES 'utf8'"); 
    mysqli_query($conn,'SET CHARACTER SET utf8');
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
 function deleteChild($conn)
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
?>