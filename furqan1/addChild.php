<?php
require('header.html');
?>
	<!-- /Nav Bar-->
<script>
	$(function()
	{
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
			data.append('reportNum', $('#Record-num').val());
			data.append('reportDate', $('#Record-date').val());
			data.append('decisionNum', $('#decision-num').val());
			data.append('decisionDate', $('#decision-date').val());
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
		<form class="col-md-6 offset-md-3" style="border: 1px solid black;width: 60%;margin: auto;padding-top: 25px;padding-bottom: 50px;text-align: center;
     box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);" id="add_child_form">
     <h1> اضافه طفل </h1>
			
				<div class="row">
					<div class="col-md-6">
						<label for="nameInput">الاسم</label>
						<input type="text" id="name" class="form-control"><br>
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
					<div class="row col-md-5 offset-5">
						<button style="margin-top:20px;color: black;
						"class="btn btn-light">حفظ</button>
					</div>		
				</div>				
			</form>
		</div>
	</div>

</body>



</html>