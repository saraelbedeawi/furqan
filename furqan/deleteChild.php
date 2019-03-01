<?php
require('header.html');
?>


    <script>
 function deletechild(id)
 {
    var data = new FormData();
    data.append('method', 'deleteChild');
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
					alert("deleted Successfully!");
                    location.reload();
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
                        .$row["national_id"]."</td><td>$gender</td><td><button class='btn btn-light' onclick='deletechild($id)'>delete</button>
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