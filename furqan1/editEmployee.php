<?php
require('header.html');
?>
<script>
     function showFields(id)
{
    jQuery.ajax(
        {
          url: "UserController.php",
          data: 'method=getEmployeeDetails&id='+id,
          type: "GET",
          success:function(data2)
          {
            var employee = JSON.parse(data2);
            $("#viewUpdate #name").val(employee.name);
            $("#viewUpdate #SSN").val(employee.SSN);
            $("#viewUpdate #DOB").val(employee.DOB);
            $("#viewUpdate #editbutton").val(id);
            $('#viewUpdate').show();
            $("#viewemployee").hide();
          }
                  
        });
}   
 function UsershowFields(id)
{
    jQuery.ajax(
        {
          url: "UserController.php",
          data: 'method=getUserDetails&id='+id,
          type: "GET",
          success:function(data2)
          {
            var employee = JSON.parse(data2);
            $("#credentials #username").val(employee.username);
            $("#credentials #Usereditbutton").val(id);
            $('#credentials').show();
           $("#viewemployee").hide();
          }
                  
        });
}



function deleteEmployee(id)
 {
     
    var data = new FormData();
    data.append('method', 'deleteEmployee');
            data.append('id',id);
            jQuery.ajax ({
        
        url: "UserController.php",
        data: data,
        type: "POST",
        cache: false,
            processData: false, // Don't process the files
            contentType: false,
      success:function(data2)
      {
          alert("done");
        //   location.reload();
      }
              
    });	
 }
 function deleteUser(id)
 {
     
    var data = new FormData();
    data.append('method', 'deleteUser');
            data.append('id',id);
            jQuery.ajax ({
        
        url: "UserController.php",
        data: data,
        type: "POST",
        cache: false,
            processData: false, // Don't process the files
            contentType: false,
      success:function(data2)
      {
       
          alert("done");
        //    location.reload();
      }
              
    });	
 }
$(function()
	{
		$("#update_employee_form").submit(function(e){
			e.preventDefault();	
			var data = new FormData();
			data.append('name',$('#name').val());
			data.append('SSN',$('#SSN').val());
			data.append('DOB',$('#DOB').val());
			data.append('method', 'UpdateEmployeeDone');
            data.append('id',$('#editbutton').val());
			data.append('gender',$('input[name=exampleRadios]:checked').val())
			jQuery.ajax({
				url: "UserController.php",
				data: data,
				type: "POST",
				cache: false,
				processData: false, // Don't process the files
				contentType: false,
				success: function(data2)
				{
					alert("Uploaded Successfully!");
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert("Upload Failed!");
				}          
			});	
		})
	});
function updateUser()
       {
           var data = new FormData();
            data.append('username', $('#username').val());
			data.append('pass', $('#pass').val());
            data.append('id',$("#credentials #Usereditbutton").val());
            data.append('method',"UpdateUser");
            jQuery.ajax ({
        
            url: "UserController.php",
            data: data,
            type: "POST",
            cache: false,
				processData: false, // Don't process the files
				contentType: false,
          success:function(data2)
          {
              alert("done");
          }
                  
        });
}
    </script>

<div class="restOfForm container-fluid">

    <div class="row">
        <?php
        echo'<div style="width:100%; margin-left: auto;margin-right: auto; text-align:center; padding-top:20px;padding-bottom:20px;"> 
        <h1> تفاصيل الموظفون</h1></div>';
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname= "dar_elfourkan";
            $conn = new mysqli($servername, $username, $password, $dbname);
            mysqli_query($conn,"SET NAMES 'utf8'"); 
            mysqli_query($conn,'SET CHARACTER SET utf8');
                $sql="select person.id,person.name,person.gender,person.national_id,role.parent_id from person INNER join role ON person.role_id=role.id WHERE person.id IN(SELECT person_id from employee) and person.isdeleted=0";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0)
                {
                    
                    echo "<table id='viewemployee' class='listTable' style='margin-left: auto;margin-right: auto;'>
                         
                          <th>الاسم</th>
                          <th>الرقم القومي</th>
                          <th>الجنس</th>
                          <th>تعديل البينات</th>
                          <th>مسح</th>
                          <th>تعديل حساب</th>";
                
                    while($row = mysqli_fetch_array($result))
                    {
                        
                        $id=$row['id'];
                        $parentid=$row['parent_id'];
                       
                        $gender=$row['gender'];
                        if($gender=='1')
                        {
                            $gender="انثي";
                        }
                        else
                        $gender="ذكر";
                        if($parentid==1)
                        {
                        echo "<tr><td>".$row['name']."</td><td>"
                        .$row["national_id"]."</td><td>$gender</td><td><button class='btn' onclick='showFields($id)'><i class='fa fa-edit'>تعديل بينات</button></td><td><button class='btn'onclick='deleteUser($id)'><i class='fa fa-trash'></i>مسح</button></td>
                        <td><button class='btn'onclick='UsershowFields($id)'><i class=]fa fa-trash'></i>تعديل حساب</button></td></tr>";
                        }
                        else{
                        /////////////
                        echo "<tr><td>".$row['name']."</td><td>"
                        .$row["national_id"]."</td><td>$gender</td><td><button class='btn' onclick='showFields($id)'><i class='fa fa-edit'>تعديل</button></td><td><button class='btn'onclick='deleteEmployee($id)'><i class='fa fa-trash'></i>مسح</button></td>
                        </tr>";
                        }
                    }
                    echo "</table>";
                }
                else
                {
                    echo "<div style='font-size:25px; color: navy;text-align: center;'>There is no employeeren in the system</div>";
                }
               
                
                ?>


    </div>
        <div id="viewUpdate" style="display:none;">
        <form class="col-md-6 offset-md-3" id="update_employee_form">
			<div class="row">
					<div class="col-md-6">
						<label for="nameInput">الاسم</label>
						<input type="text" id="name" class="form-control" placeholder="الاسم"><br>
					</div>
					<div class="col-md-6">
						<label>الرقم القومي</label>
						<input id="SSN" type="text" class="form-control">
					</div>
					<div class="col-md-6">
						<label for="nameInput">تاريخ الميلاد</label>
						<input type="date" id="DOB" class="form-control"><br>
					</div>
				
					<div class="col-md-6 row">
						<div class="col-md-12">
							<label for="exampleRadios">النوع </label>
						</div>
						<div class="col-md-6">
							<div class="form-check">
								<input value="0" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
								<label class="form-check-label" for="exampleRadios1">
									ذكر
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-check">
								<input value="1"class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios" value="option1" checked>
								<label  class="form-check-label" for="exampleRadios1">
									انثي
								</label>
							</div>
						</div>
                    </div>
                    <div class="col-md-4 offset-md-5">
		<button id="editbutton"style="margin-top:20px;color: orange;"class="btn btn-light">تسجيل دخول</button>
	</div>
            </form>
            
				</div>	
		<!-- ////////////////////////////////////////////// -->
		
				
                </div>	
                <div id="credentials"style="display:none; class=" credentials row">
					<div class="col-md-6">
						<label for="nameInput">اسم المستخدم</label>
						<input type="text" id="username" class="form-control" placeholder="اسم المستخدم"><br>
					</div>
					<div class="col-md-6">
						<label for="nameInput">  كلمة السر الجديدة</label>
						<input type="password" id="pass" class="form-control"placeholder="كلمة السر"><br>
                    </div>
                    <div class="col-md-4 offset-md-5">
		<button id="Usereditbutton" onclick="updateUser()" value="" style="margin-top:20px;color: orange;"class="btn btn-light">تسجيل دخول</button>
	</div>		
