<script type="text/javascript" src="<?=base_url();?>assets/js/validation.js"></script>
<div class="row">
	<div class="col-md-8 col-md-offset-2 container-reg">
		<div class="row">
			<div class="jumbotron jumbotron-main">
				<h1>Register Your Account</h1>
			</div>
		</div>
		<?=form_open(base_url('validation/register'),array('class' => 'form-register')); ?>
		<div class='row'>
			<div class="form-group  col-md-6">
				<label for="fullname">Select User Type: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-list"></span></span>
						<?=form_dropdown('usertype',array('select user type' => 'Select user type','employee' => 'Employee', 'recident' => 'Recident'),'Selct User Type',array('class' => 'form-control', 'id' => 'usertype')); ?>
				</div>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="fullname">Enter Your Full Name: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-user"></span></span>
					<?=form_input(array('class' => 'form-control', 'id' => 'fullname', 'name' => 'fullname', 'placeholder' => 'Enter Full Name', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)' )); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="fn" ></p>
			</div>
		</div>
		<div class='row'>
			<div class="form-group  col-md-6">
				<label for="department">Enter Department: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-list"></span></span>
					<input list="department" name="department" class="form-control">
						<datalist id="department">
							<?php foreach($departments as $d): ?>
									<option value="<?= $d->deptid;?>"><?= $d->Dept_Name;?></option>
							<?php endforeach; ?>
						</datalist>
				</div>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="empnumber">Enter Employee Number: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-pencil"></span></span>
					<?=form_input(array('class' => 'form-control', 'id' => 'empnumber', 'name' => 'empnumber', 'placeholder' => 'Enter Employee Number', 'onkeyup' => 'validateField(this)','onchange' => 'validateUnique(this)' )); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="en" ></p>
			</div>
		</div>

		<div class="row">
			<div class="form-group has-feedback col-md-6">
				<label for="email">Enter E-mail Address: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
					<?=form_input(array('class' => 'form-control', 'id' => 'email', 'name' => 'email', 'placeholder' => 'Enter E-mail', 'onkeyup'=> 'validateField(this)','onchange' => 'validateUnique(this)' )); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="em" ></p>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="contact">Enter Contact Number: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>
					<?=form_input(array('class' => 'form-control', 'id' => 'contact', 'name' => 'contact', 'placeholder' => 'Enter Contact No', 'onkeyup' => 'validateField(this)','onchange' => 'validateUnique(this)')); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="ph" ></p>
			</div>
		</div>
		<div class="row" >
			<div class="form-group has-feedback col-md-6" id="ad1">
				<label for="address">Enter Office Address: (Building No/Room No)</label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
						<?=form_textarea(array('class' => 'form-control', 'rows' => '2', 'name' => 'oaddress', 'id' => 'oaddress', 'placeholder' => 'Office address', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)')); ?>
						<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" ></p>
			</div>

			<div class="form-group has-feedback col-md-6" id="ad2">
				<label for="address">Enter Address: (Building No/Room No)</label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
						<?=form_textarea(array('class' => 'form-control', 'rows' => '2', 'name' => 'address', 'id' => 'address', 'placeholder' => 'address', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)')); ?>
						<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" ></p>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<label for="gender">Gender:</label>
					<div class="radio-inline">
						<?=form_radio(array('class' => 'gender', 'id' => 'genderm', 'name' => 'gender'),'M','checked'); ?>: Male
					</div>
					<div class="radio-inline">
						<?=form_radio(array('class' => 'gender', 'id' => 'genderf', 'name' => 'gender'),'F'); ?>: Female
					</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group has-feedback col-md-6">
				<label for="password">Enter Password: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
					<?=form_password(array('name' => 'password', 'class' => 'form-control', 'id' => 'password','placeholder' => 'Enter Password','onkeyup' => 'validateField(this)')); ?>
				</div>
				<p class="bg-danger text-danger validation-error" id="pwd" ></p>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="cpassword">Confirm Password: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
					<?=form_password(array('name' => 'cpassword', 'class' => 'form-control', 'id' => 'cpassword','placeholder' => 'Confirm Password','onkeyup' => 'validate_pwd(this)')); ?>
				</div>
				<p class="bg-danger text-danger validation-error" id="cpwd" ></p>
			</div>
		</div>

		<div class = "row" >
			<div  class = "form-group col-md-6">
					<?=form_submit('submit','Submit',array('class' => 'btn btn-primary btn-lg btn-block form-buttons', 'id' => 'submit')); ?>
			</div>
			<div  class = "form-group col-md-6">
					<?=form_reset('reset','Reset',array('class' => 'btn btn-primary btn-lg btn-block form-buttons')); ?>
			</div>
		</div>

		<?=form_close(); ?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function()
{
	$("#usertype").change(function()
	{
		var dep = $(this).val();
		if(dep == "employee")
		{
			$("#address").prop('disabled',true);
		}
		else
		{
				$("#address").prop('disabled',false);
		}
	});

});

	function validateUnique(element)
	{
		validateField(element);
		var eventsource = $("#"+element.id);
		var path;
		var dataString='value='+eventsource.val();
		switch(element.id)
	  {
	    case 'empnumber':
				path='<?=base_url('validation/ValidateUniqueEmpnumber');?>';
	    break;
	    case 'email':
				path='<?=base_url('validation/ValidateUniqueEmail');?>';
	    break;
	    case 'contact':
			path='<?=base_url('validation/ValidateUniqueContact');?>';
	    break;
	  }
		$.ajax
		({
			type: "POST",
			url:path,
			data: dataString,
			cache: false,
			success: function(data)
			{
				//alert(data);
				if(data.localeCompare('success')==0)
				{
					eventsource.parentsUntil('.form-group').removeClass('has-error');
			    eventsource.next('span').removeClass('glyphicon-warning-sign');
			    eventsource.parentsUntil('.form-group').addClass('has-success');
			    eventsource.next('span').addClass('glyphicon-ok');
			    eventsource.parent().next('.validation-error').html(null);
				}
				else
				{
					alert("part2");
					eventsource.parentsUntil('.form-group').removeClass('has-success');
					eventsource.parentsUntil('.form-group').addClass('has-error');
					eventsource.next('span').addClass('glyphicon-warning-sign');
					eventsource.parent().next('.validation-error').html(data);
					eventsource.next('span').removeClass('glyphicon-ok');
				}
			}
		})
	}

</script>
