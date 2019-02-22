<?php
require('header.html');
?>
<script>
    function showFields(id)
  {
    jQuery.ajax(
        {
          url: "childBackEnd.php",
          data: 'method=showUpdate&id='+id,
          type: "GET",
          success:function(data2)
          {
            $("#viewUpdate").html(data2);
           $("#viewChild").hide();
          }
                  
        });
  }


 function UpdateChild(id, event)
 {
    event.preventDefault();
    
    var data = new FormData();
    data.append('name', $('#name').val());
			data.append('DOB', $('#DOB').val());
			data.append('gender',$('input[name=exampleRadios]:checked').val());
			data.append('nasab', $('#nasab').val());
			data.append('SSN', $('#SSN').val());
			data.append('state', $('#state').val());
			data.append('station', $('#station').val());
			data.append('district', $('#district').val());
			data.append('Record-num', $('#Record-num').val());
			data.append('Record-date', $('#Record-date').val());
			data.append('decision-num', $('#decision-num').val());
			data.append('decision-date', $('#decision-date').val());
			data.append('method', 'editChild');
            data.append('id',id);
            jQuery.ajax({
				url: "childBackEnd.php",
				data: data,
				type: "POST",
				cache: false,
				processData: false, // Don't process the files
				contentType: false,
				success: function(data2)
				{
                    $("#viewChild").show();
                    $("#viewUpdate").hide();
                    location.reload();
					alert("Uploaded Successfully!");
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert("Upload Failed!");
				}          
			});	
 }


    </script>
<div class="restOfForm container-fluid">

    <div class="row">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname= "dar_elfourkan";
            $conn = new mysqli($servername, $username, $password, $dbname);
            mysqli_query($conn,"SET NAMES 'utf8'"); 
            mysqli_query($conn,'SET CHARACTER SET utf8');
                $sql="select * from person where role_id=6";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0)
                {
                    
                    echo "<table id='viewChild' class='listTable' style='margin-left: auto;margin-right: auto;'>
                         
                          <th>الاسم</th>
                          <th>تاريخ الميلاد</th>
                          <th>الرقم القومي</th>
                          <th>الجنس</th>
                          <th>Edit</th>";
                
                    while($row = mysqli_fetch_array($result))
                    {
                        
                        $id=$row['id'];
                        $gender=$row['gender'];
                        if($gender=1)
                        {
                            $gender="انثي";
                        }
                        else
                        $gender="ذكر";


                        /////////////
                        echo "<tr><td>".$row['name']."</td><td>". $row['birth_date']."</td><td>"
                        .$row["national_id"]."</td><td>$gender</td><td><button class='btn btn-light' onclick='showFields($id)'>Edit</button>
                        </tr>";
                    }
                    echo "</table>";
                }
                else
                {
                    echo "<div style='font-size:25px; color: navy;text-align: center;'>There is no children in the system</div>";
                }
               
                
                ?>


    </div>
        <div id="viewUpdate">
        </div>
  
</div>

