
<?php
require('header.html');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $(function() {
          $("#test").change(function()
		  {
			$("#options").hide();
          var option = $('option:selected', this).val();
		  //alert(option);
		  $("#myDiv").load('receiptBackEnd.php', {selectedButtonValue : option});
       });
    });

	function saveReceipt()
	{
		var data = new FormData();
    	data.append('method', 'addReceipt');
		data.append('donationType', $('#donation').val());
		// var inputs =$("#myDiv > div > div > input");
		var inputs=$("#myDiv > div > div").find("select, input");
		inputs.each(function(index, item){
			var key = $(item).attr('id');
			var value = {};
			value.data = $(item).val();
			value.optionId = $(item).parent().attr('id');
			data.append(key,JSON.stringify(value));
		});
            jQuery.ajax({
				url: "receiptBackEnd.php",
				data: data,
				type: "POST",
				cache: false,
				processData: false, // Don't process the files
				contentType: false,
				success: function(data2)
				{
					alert("added Successfully!");
                    location.reload();
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
	
		<form class="col-md-6 offset-md-3" style="border: 1px solid black;width: 60%;margin: auto;padding-top: 25px;padding-bottom: 50px;text-align: center;
     box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);">
			<h1> اضافه ايصال </h1>
			<label>النوع</label>
			<select id='test'> 
			<option></option>
            <?php
			$conn = new mysqli('localhost', 'root', '','dar_elfourkan');
			mysqli_query($conn,"SET NAMES 'utf8'"); 
   			mysqli_query($conn,'SET CHARACTER SET utf8');
			$sql = "SELECT * FROM donation_types";
			$result = mysqli_query($conn,$sql);
            while($row=$result->fetch_assoc())
            {
			  echo '<option id="donation"value="'.$row['id'].'">'.$row['name'].'</option>';
			}
			?>
			</select>
			<div id="myDiv">Click the button to load results</div>
			
								
			</form>
	

	</div>

</body>



</html>