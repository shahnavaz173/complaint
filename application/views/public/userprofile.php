<?php
	if(!$islogin)
		redirect(base_url('login'));
?>
<?=link_tag(base_url('assets/css/bootstrap-select.min.css'));?>
<script type="text/javascript" src="<?=base_url('assets/js/validation.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap-select.min.js');?>"></script>
<div class="row">
	<div class="col-md-8 col-md-offset-2 container-reg">
		<div class="row">
			<div class="jumbotron jumbotron-main">
				<h1>Your Account Details</h1>
			</div>
		</div>
		<?=form_open(base_url('Site/update_profile'),array('class' => 'form-register')); ?>
		<div class='row'>
			<div class="form-group  col-md-6">
				<label for="fullname">User Type: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-list"></span></span>
						<?=form_dropdown('usertype',array('' => 'Select user type','employee' => 'Employee', 'recident' => 'Recident'),$udetails[0]->u_type,array('class' => 'form-control', 'id' => 'usertype', 'required' => 'required','disabled'=>'true')); ?>
				</div>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="fullname">Full Name: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-user"></span></span>
					<?=form_input(array('class' => 'form-control', 'id' => 'fullname','value' => $udetails[0]->full_name,'name' => 'fullname', 'placeholder' => 'Enter Full Name', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)', 'autocomplete' => 'off', 'required' => 'required','disabled'=>'true' )); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="fn" ></p>
			</div>
		</div>
		<div class='row'>
			<div class="form-group  col-md-6">
				<label for="department">Department: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-list"></span></span>
						<select name="department" id="department" class="form-control selectpicker" data-live-search="true" required disabled>

              <?php foreach($departments as $d): ?>
                <?php if($udetails[0]->deptid == $d->deptid): ?>
									<option value="<?=$d->deptid; ?>" checked><?=$d->Dept_Name; ?></option>
								<?php else: ?>
									<option value="<?=$d->deptid; ?>"><?=$d->Dept_Name; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
				</div>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="empnumber">Employee Number: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-pencil"></span></span>
					<?=form_input(array('class' => 'form-control', 'id' => 'empnumber', 'value' =>$udetails[0]->emp_no,'name' => 'empnumber', 'placeholder' => 'Enter Employee Number','onkeyup' => 'validateField(this)','onchange' => 'validateUnique(this)','autocomplete' => 'off',  'required' => 'required' ,'disabled'=>'true')); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="en" ></p>
			</div>
		</div>

		<div class="row">
			<div class="form-group has-feedback col-md-6">
				<label for="email">E-mail Address: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
					<?=form_input(array('class' => 'form-control', 'id' => 'email', 'name' => 'email','value' =>$udetails[0]->email, 'placeholder' => 'Enter E-mail', 'onkeyup'=> 'validateField(this)','onchange' => 'validateUnique(this)', 'autocomplete' => 'off',  'required' => 'required' )); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="em" ></p>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="contact">Contact Number: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>
					<?=form_input(array('class' => 'form-control', 'id' => 'contact', 'value' =>$udetails[0]->pho_no,'name' => 'contact', 'placeholder' => 'Enter Contact No', 'onkeyup' => 'validateField(this)','onchange' => 'validateUnique(this)', 'autocomplete' => 'off',  'required' => 'required')); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="ph" ></p>
			</div>
		</div>
		<div class="row" >
			<div class="form-group has-feedback col-md-6" id="ad1">
				<label for="address">Office Address: (Office No/Room No)</label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
						<?=form_textarea(array('class' => 'form-control', 'rows' => '2', 'name' => 'oaddress','value' =>$udetails[0]->office_location,'id' => 'oaddress', 'placeholder' => 'Office address', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)',  'required' => 'required')); ?>
						<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" ></p>
			</div>

			<div class="form-group has-feedback col-md-6" id="ad2">
				<label for="address">Address: (Building No/Room No)</label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
						<?=form_textarea(array('class' => 'form-control', 'rows' => '2', 'name' => 'address', 'id' => 'address','value' =>$udetails[0]->address, 'placeholder' => 'address', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)')); ?>
						<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" ></p>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-12">
				<label for="gender">Gender:</label>
					<?php if($udetails[0]->gender == 'M'): ?>
						<div class="radio-inline">
						  <input type="radio" name="gender" id="genderm" required="required" class="gender" value="M" checked disabled/>: Male
						</div>
	      		<div class="radio-inline">
	            <input type="radio" name="gender" id="genderf" required="required" class="gender"  value="F" disabled/>: Female
						</div>
					<?php else: ?>
						<div class="radio-inline">
							<input type="radio" name="gender" id="genderm" required="required" class="gender" value="M" disabled/>: Male
						</div>
						<div class="radio-inline">
							<input type="radio" name="gender" id="genderf" required="required" class="gender"  value="F" checked disabled/>: Female
						</div>

					<?php endif; ?>
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


	function validateUnique(element)
	{

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
				if(data == true)
				{
					validateField(element);
				}
				else
				{
					eventsource.parentsUntil('.form-group').removeClass('has-success');
					eventsource.parentsUntil('.form-group').addClass('has-error');
					eventsource.next('span').addClass('glyphicon-warning-sign');
					eventsource.parent().next('.validation-error').html(data);
					eventsource.next('span').removeClass('glyphicon-ok');
				}
			}
		});
	}

</script>
