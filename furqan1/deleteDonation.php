<?php
require('header.html');
?>



<script>
      function showFields(id)
{
    $('#updateButton').val(id);
    jQuery.ajax(
        {
            url: "donationTypesController.php",
          data: 'method=getoptions&id='+id,
          type: "GET",
         
          success:function(option)
          {
            var options = JSON.parse(option);
				options.forEach(function(item,index) 
                {
                    if(item.donationName!=false)
                    {
                        $("#donationName").val(item.donationName);
                    }
					$('#options')
						.append($("<option></option>")
						.attr("value",item.id)
						.attr("selected", item.selected)
						.text(item.name));
                          $("#viewUpdate #editbutton").val(id);
                    $('#viewUpdate').show();
                    $("#viewDonationTypes").hide();
				});

				$('#options').selectpicker();
			
           
          }
                  
        });
}

function Update(btn)
 { 
    // jQuery code goes here
    var id = btn;
	var data = new FormData();
	var arr = [];
	var arr2 = [];
    data.append('method','EditDonationType');
	data.append('donationType',$("#donationName").val());
    data.append('id',id);
	for(var i=0; i<$("#options :selected").length;i++)
		 {
			arr.push($('#options :selected')[i].value);
		 }
		 data.append('selectedValues', JSON.stringify(arr));
		for(var i=0; i<$("#inputrows input").length;i++)
		{
			var obj = {};
			obj.name = $("#inputrows input")[i].value;
			obj.TypeId = $("#inputrows select")[i].value;
				arr2.push(obj);
				
		}
        data.append("type",JSON.stringify(arr2));
      	jQuery.ajax({
			url: "donationTypesController.php",
				data: data,
				type: "POST",
				cache: false,
				processData: false, // Don't process the files
				contentType: false,
				success: function(data2)
				{
					alert("added Successfully!");
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert("Upload Failed!");
				} 
			
			         
      	});
}

function filltypes()
{ 
    // jQuery code goes here


      	jQuery.ajax({
			url: "donationTypesController.php",
			data: 'method=getoptionsTypes',
			type: "GET",
		
			success:function(option)
			{
			//   convert convert string returned to json array
			var options = JSON.parse(option);
			options.forEach(function(item,index) {
				$("#inputrows select:last-child").last()
				.append($("<option></option>")
						.attr("value",item.id)
						.text(item.type)); 
			});
			
			}          
      	});
}
function deleteDonation(id)
{
    var data = new FormData();
    data.append('method', 'deleteDonation');
            data.append('id',id);
            jQuery.ajax({
				url: "donationTypesController.php",
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
            $sql="select * from donation_types where isdeleted=0";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0)
            {
                
                echo "<table id='viewDonationTypes' class='listTable' style='margin-left: auto;margin-right: auto;'>
                     
                      <th>الاسم</th>
                      <th>تعديل</th>
                      <th>مسح</th>";
            
                while($row = mysqli_fetch_array($result))
                {
                    
                    $id=$row['id'];
                    echo "<tr><td>".$row['name']."</td><td><button class='btn' onclick='showFields($id)'><i class='fa fa-edit'>تعديل</button></td><td><button class='btn'onclick='deleteDonation($id)'><i class=]fa fa-trash'></i>مسح</button></td>
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
<div id="viewUpdate" style="display:none;">
<label>اسم التبرع</label>
                    <input id="donationName" type="text"><br>
                    <select id="options" multiple data-live-search="true">
                </select>
                <button id="addInput">  اضافه نوع اخر</button><br>
			<div id="inputrows"></div>
            <div>
       	 		<button value="" id="updateButton" onclick="Update(this.value)">حفظ</button><br>		
			</div>			
		</div>
</div>
<script>
    $(document).ready(function() {
       
       $("button[id='addInput']").click(function() {
           var domElement = $('<div class="row col-md-8"><input name="name[]" type ="text">  </input><select name="type[]"></select> </div>');
           $("#inputrows").append(domElement);
		   filltypes();
       });
        
   });
    </script>