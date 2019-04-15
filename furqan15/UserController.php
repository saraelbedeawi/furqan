<?php
set_include_path('./');
include_once './models/user.php';
include_once './models/person.php';
include_once './models/page.php';
include_once "./models/role.php";
include_once "./models/employee.php";
include_once "./helpers/ViewHelper.php";

if(isset($_POST['method']) && $_POST['method']=="login")
{
   login();
   
}
if(isset($_POST['method']) && $_POST['method']=="UpdateEmployeeDone")
{
   UpdateEmployee();
   
}

if(isset($_POST['method']) && $_POST['method']=="addEmployeeDone")
{
    addEmployeeDone();
}
if(isset($_GET['method']) && $_GET['method']=="getRoles")
{
    getRoles();
}
if(isset($_GET['method']) && $_GET['method']=="logOut")
{
    signOut();
}
if(isset($_GET['method']) && $_GET['method']=="getEmployeeDetails")
{
    getEmployeeDetails();
}
if(isset($_GET['method']) && $_GET['method']=="getUserDetails")
{
    getUserDetails();
}
if(isset($_GET['method']) && $_GET['method']=="getEmployees")
{
    getEmploye();
}
if(isset($_GET['method']) && $_GET['method']=="viewEmployees")
{
    view("editEmployee.html");
}
if(isset($_GET['method']) && $_GET['method']=="AddEmployeeView")
{
    view("addEmployee.html");
}

if(isset($_POST['method']) && $_POST['method']=="UpdateUser")
{
    UpdateUser();
} 
if(isset($_POST['method']) && $_POST['method']=="deleteEmployee")
{
    DeleteEmployee();
}
if(isset($_POST['method']) && $_POST['method']=="deleteUser")
{
    DeleteUser();
}  



function login()
{   
   
   $password=$_POST['pass'];
   $enc=sha1($password,false);

   $user = new user();
   $user->username=$_POST['name'];
   $user->password=$enc;
   $user->login();

   if($user->login()===false)
   {
    $redirect = array();
    $redirect["status"] = "failed";
    echo json_encode($redirect);
   }
   //CHECK IF USER NOT FOUND
    else
    {
   $person = new person();
   $person = $person->GetById($user->personId);

   $page = new page();
   $page = $page->GetByRoleId($person->roleId);

   session_start();
   $_SESSION["personId"]= $person->id;
   $_SESSION["userId"]= $user->id;
   $_SESSION["person"]= $person;
   $_SESSION["user"]= $user;
   $redirect = array();
   $redirect["status"] = "success";
   $redirect["url"] = $page->physicalAddress;
   echo json_encode($redirect);
    }
}

function addEmployeeDone()
{   
    
    // mysqli_query($conn,"SET NAMES 'utf8'"); 
    // mysqli_query($conn,'SET CHARACTER SET utf8'); 
    $person = new person();
    $person->name=$_POST['name'];
    $person->nationalId=$_POST['SSN'];
    $person->birthDate=$_POST['DOB'];
    $person->gender=$_POST['gender'];
    $person->roleId=$_POST['roleId'];
    $personId=$person->Insert();
    $emp=new employee();
    $emp->personId=$personId;
    $emp->Insert();

    if($_POST['parentId']==1)
    {
    $user =new user();
    $user->username=$_POST['username'];
    $user->password=sha1($_POST['pass'],false);
    $user->personId= $personId;
    $user->Insert(); 

   }
}
function getRoles()
{ 
     $parentId=$_GET['parentId'];
    $role = new role();
    $roles = $role->GetById($parentId);
    
    echo json_encode($roles);
}
function signOut()
{
    $user = new user();
    $user->signOut(); 
    
}
function getEmployeeDetails()
{
    $employee = new employee();
    $employeeid=$_GET['id'];
    $row=$employee->getById($employeeid);
    $name=$row['name'];
    $DOB=$row['birth_date'];
    $SSN=$row['national_id'];
    $gender=$row['gender'];
    $replacement_array = array(
        'name' => $name,
        'DOB'=>$DOB,
        'SSN'=>$SSN,
        'gender'=>$gender,);
        echo json_encode($replacement_array);
}
function getUserDetails()
{
    $user=new user();
   $id= $_GET['id'];
   $user->TableId="person_id";
   $row=$user->GetById($id);
   $name=$row['username'];
   $Userid=$row['id'];
   $replacement_array = array(
    'username' => $name,
    'userid'=>$Userid);
    echo json_encode($replacement_array);
}
function UpdateEmployee()
{
    
    $person=new person();
    $person->id= $_POST['id'];
    $person->name=$_POST['name'];
    $person->nationalId=$_POST['SSN'];
    $person->birthDate=$_POST['DOB'];
    $person->gender=$_POST['gender'];
    $person->Update();
}
function UpdateUser()
{
    $user =new user();
    $user->username=$_POST['username'];
    $user->password=sha1($_POST['pass'],false);
    $user->id=$_POST['id'];
    $user->TableId="person_id";
    $user->Update();
}
 function DeleteEmployee()
 {
    $person=new person();
    $person->id= $_POST['id'];
    $person->isdeleted=1;
    $person->deletePerson();
    $employee = new employee();
    $employee->TableId="person_id";
    $employee->isdeleted=1;
    $employee->id=$_POST['id'];
    $employee->Delete();

 }
 function DeleteUser()
 {
    $person=new person();
    $person->id= $_POST['id'];
    $person->isdeleted=1;
    $person->deletePerson();
    $user =new user();
    $user->TableId="person_id";
    $user->isdeleted=1;
    $user->id=$_POST['id'];
    $user->Delete();
    $employee = new employee();
    $employee->TableId="person_id";
    $employee->isdeleted=1;
    $employee->id=$_POST['id'];
    $employee->Delete();

 }


function getEmploye()
{
    $person=new person();
     $arr=array();
     $rows=$person->getEmployees();
     foreach ( $rows as $row )  
     { 
        $person=new person;
        $person->id = $row['id'];
        $person->name = $row['name'];
        $person->nationalId = $row['national_id'];
        $person->gender = $row['gender'];
        $person->parentId=$row['parent_id'];

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