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
include_once "./signin.php";
if(isset($_POST['method']) && $_POST['method']=="addUser")
{
    addUser($conn);
    //echo"<script type='text/javascript'>alert("isset");</script>";

}
function addUser($conn)
 {   
    //echo"<script type='text/javascript'>alert("userrrr");</script>";
    mysqli_query($conn,"SET NAMES 'utf8'"); 
    mysqli_query($conn,'SET CHARACTER SET utf8'); 
    $name=$_POST['name'];
    $password=$_POST['pass'];
    $enc=sha1($password,false);
    //echo '<div><p>username=".$name."password=".$password</p></div>';
   // echo"<div> <p>$name</p><p>$password</p></div>";
 //  INSERT INTO `user` ( `username`, `password`, `person_id`) VALUES ( '$name', '$enc', '18');
    $sql="INSERT INTO `user` ( `username`, `password`, `person_id`) VALUES ( '$name', '$enc', '18')";
    //$sql="insert into case_details(case_id,document_id) values ($caseId, $document_id)";
    $result = mysqli_query($conn,$sql);

 }
 
?>