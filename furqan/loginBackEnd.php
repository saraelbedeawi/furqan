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
    
  // $sql="INSERT INTO `user` ( `username`, `password`, `person_id`) VALUES ( '$name', '$enc', '18')";
    
   // $result = mysqli_query($conn,$sql);
  // echo "<script type='text/javascript'>alert('hnaa);</script>";

    $sql = "SELECT * FROM `user` WHERE `username`= '$name' and `password` =  '$enc' ";
    $result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) 
    { 


      echo "<script type='text/javascript'>window.top.location='http://google.com/';</script>";
         // header("Location:index.php");
         //    exit();
   //  $sql="INSERT INTO `user` ( `username`, `password`, `person_id`) VALUES ( 'test', 'test', '18')";
    
   //  $result = mysqli_query($conn,$sql);
  
        
    } 
    else {
       // echo "<script type='text/javascript'>alert('wrong email or password');</script>";
        
    }

 }
 
?>