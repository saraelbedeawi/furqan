<?php
require('header.html');
?>


<script>

$(document).ready(function() {
    // jQuery code goes here


      	jQuery.ajax({
			url: "donationTypesController.php",
			data: 'method=getoptions&id=0',
			type: "GET",
		
			success:function(option)
			{
			//   convert convert string returned to json array
				var options = JSON.parse(option);
				options.forEach(function(item,index) {
					$('#options')
						.append($("<option></option>")
						.attr("value",item.id)
						
						.text(item.name)); 
				});

				$('#options').selectpicker();
			
			}          
      	});
});

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





function add()
 { 
    // jQuery code goes here
	var data = new FormData();
	var arr = [];
	var arr2 = [];
    data.append('method','addDonationType');
	data.append('donationType',$("#donationName").val());
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

</script>
<body>
	<!-- Big Form-->

	<div class="restOfForm row">
	
		<div class="myDiv col-md-6 offset-md-4" style="border: 1px solid black;width: 60%;margin: auto;padding-top: 25px;padding-bottom: 50px;text-align: center;
     box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);">
		
			اضافه نوع تبرع جديد
			<br>
				<label>اسم التبرع</label>
					<input id="donationName" type="text"><br>
                <label>البيانات</label>
                
                <select id="options" multiple data-live-search="true">
                </select>		
			<button id="addInput">  اضافه نوع اخر</button><br>
			<div id="inputrows"style="margin:auto; padding-top:5px;"></div>
            <div>
       	 		<button class="btn btn-outline-secondary" onclick="add()">حفظ</button><br>		
			</div>			
		</div>
    </div>
    <script>
        

   $(document).ready(function() {
       
       $("button[id='addInput']").click(function() {
           var domElement = $('<div style="margin:auto; padding-top:5px;"><input name="name[]" type ="text">  </input><select name="type[]"></select> </div>');
           $("#inputrows").append(domElement);
		   filltypes();
       });
        
   });
        </script>

</body>
