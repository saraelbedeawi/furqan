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
			parentId=$("input[type='radio'][name='systemUser']:checked").val();
			data.append('name',$('#name').val());
			data.append('SSN',$('#SSN').val());
			data.append('DOB',$('#DOB').val());
			data.append('roleId',$('#nonSystemuser').val());
			data.append('parentId',parentId);
			data.append('method', 'addEmployeeDone');
			data.append('gender',$('input[name=exampleRadios]:checked').val())
			if(parentId==1)
			{
			data.append('username', $('#username').val());
			data.append('pass', $('#pass').val());
			}
			
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





$(function() {
	$('input[type="radio"][name="systemUser"]').click(function()
	{
		$("#nonSystemuser option").remove();
		parentId=$("input[type='radio'][name='systemUser']:checked").val();
		if(parentId==1)
		{
			$("#credentials").show();
		}
		else
		{
			$("#credentials").hide();
		}
      	jQuery.ajax({
			url: "UserController.php",
			data: 'method=getRoles&parentId='+parentId,
			type: "GET",
		
			success:function(role)
			{
			//   convert convert string returned to json array
			var roles = JSON.parse(role);
			roles.forEach(function(item,index) {
				$('#nonSystemuser')
				.append($("<option></option>")
						.attr("value",item.id)
						.text(item.name)); 
			});
			
			}          
      	});
    });
});

	</script>

	<!-- Big Form-->
	<div class="restOfForm container-fluid">
		<div class="row">
		<form class="col-md-6 offset-md-3" style="border: 1px solid black;width: 60%;margin: auto;padding-top: 25px;padding-bottom: 50px;text-align: center;
     box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);" id="add_user_form">
     		<h1>اضافه موظف</h1>
			
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
				</div>
				<div class="row">
					<div class="col-md-3 offset-md-3">
						<div class="form-check">
							<input value="1" class="form-check-input" type="radio" name="systemUser" id="systemUser1" checked>
							<label class="form-check-label" for="systemUser">
								مستخدم
							</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-check">
							<input value="2"class="form-check-input" type="radio" name="systemUser" id="systemUser">
							<label  class="form-check-label" for="systemUser">
								غير مستخدم
							</label>
						</div>
					</div>
				
				</div>	
				<div id="nonSystemuser1"class="row">
					<div class="col-md-7">
						<label >الوظيفه</label>
						<select class="form-control col-md-6"  id="nonSystemuser"></select>
					</div>
				</div>
		<!-- ////////////////////////////////////////////// -->
		
				<div id="credentials"class=" credentials row">
					<div class="col-md-6">
						<label for="nameInput">اسم المستخدم</label>
						<input type="text" id="username" class="form-control" placeholder="اسم المستخدم"><br>
					</div>
					<div class="col-md-6">
						<label for="nameInput"> كلمة السر</label>
						<input type="password" id="pass" class="form-control"placeholder="كلمة السر"><br>
					</div>
				</div>


<div class="col-md-4 offset-md-5">
		<button style="margin-top:20px;color: orange;"class="btn btn-light">تسجيل دخول</button>
	</div>
				

			
</form>
</div>
</div>	
</body>
</html>