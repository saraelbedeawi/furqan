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
            var child = JSON.parse(data2);
            $("#viewUpdate #name").val(child.name);
            $("#viewUpdate #SSN").val(child.SSN);
            $("#viewUpdate #nasab").val(child.relative);
            $("#viewUpdate #station").val(child.station);
            $("#viewUpdate #district").val(child.district);
            $("#viewUpdate #DOB").val(child.DOB);
            $("#viewUpdate #state").val(child.state);
            $("#viewUpdate #Record-num").val(child.report_num);
            $("#viewUpdate #Record-date").val(child.report_date);
            $("#viewUpdate #decision-num").val(child.decision_number);
            $("#viewUpdate #decision-date").val(child.decision_date);
            // $("input[name=exampleRadios]").val(child.gender);
    //         $('input:radio[name="exampleRadios"][value="child.gender"]')
    // .attr('checked', true);
            $("#viewUpdate #editbutton").val(id);
            $('#viewUpdate').show();
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
			data.append('reportNum', $('#Record-num').val());
			data.append('reportDate', $('#Record-date').val());
			data.append('decisionNum', $('#decision-num').val());
			data.append('decisionDate', $('#decision-date').val());
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
                $sql="select * from person where role_id=6 and isdeleted=0";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0)
                {
                    echo'<div id="viewChild" style="width:100%; margin-left: auto;margin-right: auto; 
                    text-align:center; padding-top:20px;padding-bottom:20px;"> <h1> بينات الأطفال</h1>';
                    echo "<table id='' class='listTable' style='margin-left: auto;margin-right: auto;'>
                         
                          <th>الاسم</th>
                          <th>تاريخ الميلاد</th>
                          <th>الرقم القومي</th>
                          <th>الجنس</th>
                          <th>تعديل</th>
                          <th>مسح</th>";
                
                    while($row = mysqli_fetch_array($result))
                    {
                        
                        $id=$row['id'];
                        $gender=$row['gender'];
                        if($gender=='1')
                        {
                            $gender="انثي";
                        }
                        else
                        $gender="ذكر";


                        /////////////
                        echo "<tr><td>".$row['name']."</td><td>". $row['birth_date']."</td><td>"
                        .$row["national_id"]."</td><td>$gender</td><td><button class='btn' onclick='showFields($id)'><i class='fa fa-edit'>تعديل</button></td><td><button class='btn'onclick='deletechild($id)'><i class='fa fa-trash'></i>مسح</button></td>
                        </tr>";
                    }
                    echo "</table>";
                    echo"</div>";
                }
                else
                {
                    echo "<div style='font-size:25px; color: navy;text-align: center;'>There is no children in the system</div>";
                }
               
                
                ?>


    </div>
        <div id="viewUpdate" style="display:none;">
        <form class="col-md-6 offset-md-3" style="border: 1px solid black;width: 60%;margin: auto;padding-top: 25px;padding-bottom: 50px;text-align: center;
     box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);" id="add_child_form">
     <h1> تعديل الطفل </h1>
         <div class="row">
             <div class="col-md-6">
                 <label for="nameInput">الاسم</label>
                 <input type="text" id="name" value='' class="form-control"><br>
             </div>
             <div class="col-md-6">
                 <label for="nameInput">تاريخ الميلاد</label>
                 <input type="date" id="DOB" value='' class="form-control"><br>
             </div>
         </div>
         
         <div class="row">
             <div class="col-md-6">
                 <label>النسب</label>
                 <input id="nasab" type="text" value='' class="form-control" >
             </div>
             <div class="col-md-6">
                 <label>الرقم القومي</label>
                 <input id="SSN" type="text" value=''class="form-control">
             </div>
         </div>
         <div class="row">
             <div class="col-md-6">
                 <label>محافظه العثور</label>
                 <input id="state" type="text" value=''  class="form-control">
             </div>
             <div class="col-md-6">
                 <label>قسم / مركز</label>
                 <input id="station" type="text" value='' class="form-control">
             </div>
         </div>
         <div class="row">
             <div class="col-md-6">
                 <label>حي / شياخه</label>
                 <input id="district" type="text" value='' class="form-control">
             </div>
             <div class="col-md-6">
                 <label>رقم المحضر</label>
                 <input id="Record-num" type="text" value='' class="form-control">
             </div>
         </div>
         <div class="row">
             <div class="col-md-6">
                 <label>تاريخ المحضر</label>
                 <input id="Record-date" type="date" value='' class="form-control">
             </div>
             <div class="col-md-6">
                 <label>رقم قرار النيابه</label>
                 <input id="decision-num" type="text" value='' class="form-control">
             </div>
         </div>
         <div class="row">
             <div class="col-md-6">
                 <label>تاريخ قرار النيابه</label>
                 <input id="decision-date"type="date" value='' class="form-control">
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
 
         <div class="col-md-4 offset-md-2">
         <button style="margin-top:20px;color: black;
         "class="btn btn-light" id="editbutton" value="" onclick="UpdateChild(this.value, event)">حفظ</button>
     </div>
          </div>   
             
     </form>
</div>
  


