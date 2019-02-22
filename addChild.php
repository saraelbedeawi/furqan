<?php
require('header.html');
?>
	<!-- /Nav Bar-->
<script>
	$(function(){
		$("#add_child_form").submit(function(e){
			e.preventDefault();	
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
			data.append('method', 'addChild');
			jQuery.ajax({
				url: "childBackEnd.php",
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
			<form class="col-md-6 offset-md-3" id="add_child_form">
				<div class="row">
					<div class="col-md-6">
						<label for="nameInput">الاسم</label>
						<input type="text" id="name" class="form-control" placeholder="الاسم"><br>
					</div>
					<div class="col-md-6">
						<label for="nameInput">تاريخ الميلاد</label>
						<input type="date" id="DOB" class="form-control"><br>
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
				
				<div class="row">
					<div class="col-md-6">
						<label>النسب</label>
						<input id="nasab" type="text" class="form-control" >
					</div>
					<div class="col-md-6">
						<label>الرقم القومي</label>
						<input id="SSN" type="text" class="form-control">
					</div>
					<div class="col-md-6">
						<label>محافظه العثور</label>
						<input id="state" type="text" class="form-control">
					</div>
					<div class="col-md-6">
						<label>قسم / مركز</label>
						<input id="station" type="text" class="form-control">
					</div>
					<div class="col-md-6">
						<label>حي / شياخه</label>
						<input id="district" type="text" class="form-control">
					</div>
					<div class="col-md-6">
						<label>رقم المحضر</label>
						<input id="Record-num" type="text" class="form-control">
					</div>
					<div class="col-md-6">
						<label>تاريخ المحضر</label>
						<input id="Record-date" type="date" class="form-control">
					</div>
					<div class="col-md-6">
						<label>رقم قرار النيابه</label>
						<input id="decision-num" type="text" class="form-control">
					</div>
					<div class="col-md-6">
						<label>تاريخ قرار النيابه</label>
						<input id="decision-date"type="date" class="form-control">
					</div>
					<div class="col-md-4 offset-md-2">
						<button style="margin-top:20px;color: orange;
						"class="btn btn-light">حفظ</button>
					</div>		
				</div>				
			</form>
		</div>
	</div>

</body>



</html>