
<!DOCTYPE html>
<html dir="rtl">
	<!-- /Nav Bar-->
<script>
	function login()
		{
			
			var data = new FormData();		
			data.append('name', $('#name').val());
			//alert($('#name').val());
			data.append('pass', $('#pass').val());
			//alert($('#pass').val());
			data.append('method', 'login');
			jQuery.ajax({
				url: "UserController.php",
				data: data,
				type: "POST",
				cache: false,
				processData: false, // Don't process the files
				contentType: false,
				success: function(data)
				{
					data = JSON.parse(data);
					if(data.status=="success")
						window.location.replace(data.url);
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					alert("Upload Failed!");
				}          
			});	
		
		}

	</script>
	<head>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	

		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

		<script
			src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"
			integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k"
			crossorigin="anonymous"></script>

</head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<div class="container">
  <div class="top">
    <img class="logo" src="images/logo.jpg"/>
    <form class="col-md-6 offset-md-3" id="add_user_form">
		<label for="mail">
      الاسم
      <input id="name" type="text" placeholder=""/>
    </label>
    <label for="passpen">
	كلمة السر
      <input id="pass" type="password" placeholder="***********" />
    </label>
  </div>
  
  <div class="bottom col-md-4 offset-md-2">
						<button onclick="login()"style="margin-top:20px;color: orange;
						"class="btn btn-light"> دخول</button>
  </div>
  </form>
</div>


	<!-- Big Form-->
	<!-- <div class="restOfForm container-fluid">
		<div class="row">
			
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
						"class="btn btn-light"> دخول</button>
					</div>		
				</div>				
			</form>
		</div>
	</div> -->
</body>
</html>