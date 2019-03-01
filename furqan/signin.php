<?php
require('header.html');
?>
	<!-- /Nav Bar-->
<script>
	$(function()
	{
		$("#add_user_form").submit(function(e){
			e.preventDefault();	
			var data = new FormData();		
			data.append('name', $('#name').val());
			alert($('#name').val());
			data.append('pass', $('#pass').val());
			alert($('#pass').val());
			data.append('method', 'addUser');
			jQuery.ajax({
				url: "signinBackEnd.php",
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

	</script>

	<!-- Big Form-->
	<div class="restOfForm container-fluid">
		<div class="row">
			<form class="col-md-6 offset-md-3" id="add_user_form">
				<div class="row">
					<div class="col-md-6">
						<label for="nameInput">الاسم</label>
						<input type="text" id="name" class="form-control" placeholder="الاسم"><br>
					</div>
					<div class="col-md-6">
						<label for="nameInput"> كلمة السر</label>
						<input type="password" id="pass" class="form-control"placeholder="كلمة السر"><br>
					</div>
				</div>
				
					<div class="col-md-4 offset-md-2">
						<button style="margin-top:20px;color: orange;
						"class="btn btn-light">تسجيل دخول</button>
					</div>		
				</div>				
			</form>
		</div>
	</div>
</body>
</html>