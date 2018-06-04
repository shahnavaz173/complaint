
<?=link_tag(base_url('assets/css/bootstrap-select.min.css'));?>
<script type="text/javascript" src="<?=base_url('assets/js/validation.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap-select.min.js');?>"></script>
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
						<?=form_dropdown('usertype',array('' => 'Select user type','employee' => 'Employee', 'recident' => 'Recident'),'Selct User Type',array('class' => 'form-control', 'id' => 'usertype', 'required' => 'required')); ?>
				</div>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="fullname">Enter Your Full Name: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-user"></span></span>
					<?=form_input(array('class' => 'form-control', 'id' => 'fullname', 'name' => 'fullname', 'placeholder' => 'Enter Full Name', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)', 'autocomplete' => 'off', 'required' => 'required' )); ?>
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
						<select name="department" id="department" class="form-control selectpicker" data-live-search="true" required>
							<?php foreach($departments as $d): ?>
									<option value="<?= $d->deptid;?>"><?= $d->Dept_Name;?></option>
							<?php endforeach; ?>
						</select>
				</div>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="empnumber">Enter Employee Number: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-pencil"></span></span>
					<?=form_input(array('class' => 'form-control', 'id' => 'empnumber', 'name' => 'empnumber', 'placeholder' => 'Enter Employee Number','onkeyup' => 'validateField(this)','onchange' => 'validateUnique(this)','autocomplete' => 'off',  'required' => 'required' )); ?>
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
					<?=form_input(array('class' => 'form-control', 'id' => 'email', 'name' => 'email', 'placeholder' => 'Enter E-mail', 'onkeyup'=> 'validateField(this)','onchange' => 'validateUnique(this)', 'autocomplete' => 'off',  'required' => 'required' )); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="em" ></p>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="contact">Enter Contact Number: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>
					<?=form_input(array('class' => 'form-control', 'id' => 'contact', 'name' => 'contact', 'placeholder' => 'Enter Contact No', 'onkeyup' => 'validateField(this)','onchange' => 'validateUnique(this)', 'autocomplete' => 'off',  'required' => 'required')); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="ph" ></p>
			</div>
		</div>
		<div class="row" >
			<div class="form-group has-feedback col-md-6" id="ad1">
				<label for="address">Enter Office Address: (Office No/Room No)</label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
						<?=form_textarea(array('class' => 'form-control', 'rows' => '2', 'name' => 'oaddress', 'id' => 'oaddress', 'placeholder' => 'Office address', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)',  'required' => 'required')); ?>
						<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" ></p>
			</div>

			<div class="form-group  has-feedback col-md-6" id="ad2">
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
			<div class="form-group has-feedback  col-md-6">
				<label>Select profile Photo:</label>
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-primary ">
							Browse&hellip; <input type="file" id="file" style="display:none;">
						</span>
					</label><input type="text"id="filename" class="form-control" readonly>

				</div>
				<p class="bg-danger text-danger validation-error img-err" ></p>
			</div>
			<div class="form-group col-md-6 ">
				<label for="gender">Gender:</label><br />
					<div class="radio-inline">
						<?=form_radio(array('class' => 'gender', 'id' => 'genderm', 'name' => 'gender', 'required' => 'required'),'M','checked'); ?>: Male
					</div>
					<div class="radio-inline">
						<?=form_radio(array('class' => 'gender', 'id' => 'genderf', 'name' => 'gender',  'required' => 'required'),'F'); ?>: Female
					</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group has-feedback col-md-6">
				<label for="password">Enter Password: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
					<?=form_password(array('name' => 'password', 'class' => 'form-control', 'id' => 'password','placeholder' => 'Enter Password','onkeyup' => 'validateField(this)',  'required' => 'required')); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="pwd" ></p>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="cpassword">Confirm Password: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
					<?=form_password(array('name' => 'cpassword', 'class' => 'form-control', 'id' => 'cpassword','placeholder' => 'Confirm Password','onkeyup' => 'validate_pwd(this)',  'required' => 'required')); ?>
					<span class="glyphicon  form-control-feedback"></span>
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
	$("#file").change(function()
	{
		var file = document.getElementById('file').files[0];
		$("#filename").val(file.name);
		uploadImage(file,"profile");
	});
});
function uploadImage(property,forwhat)
{

	var image_name = property.name;
	var image_extension = image_name.split('.').pop().toLowerCase();
	if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png']) == -1)
	{
		$(".img-err").text("Invalid file format please Select an Image file");
	}
	else if(property.size > 102400)
	{
		$(".img-err").text("File Size Should be less then 100kb");
	}
	else
	{
		var formData = new FormData();
		var filename = forwhat+$("#empnumber").val()+"."+image_extension;
		formData.append("file",property);
		formData.append("filename",filename);
		$.ajax
		({
			method: "POST",
			url: "upload/upload_image",
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function()
			{
				$(".img-err").text("Uploading...");
			},
			success: function(data)
			{
				if(data == "No Errror")
				{
					$("#filename").parentsUntil('.form-group').removeClass('has-error');
					$("#filename").parentsUntil('.form-group').addClass('has-success');
					$("#filename").next('span').addClass('glyphicon-ok');
					$("#filename").parent().next('.validation-error').html("<input type='hidden' name='profilephoto' value='"+filename+"' /> ");
					$("#filename").next('span').removeClass('glyphicon-warning-sign');
				}
				else
				{
					$("#filename").parentsUntil('.form-group').removeClass('has-success');
					$("#filename").parentsUntil('.form-group').addClass('has-error');
					$("#filename").next('span').addClass('glyphicon-warning-sign');
					$("#filename").parent().next('.validation-error').html(data);
					$("#filename").next('span').removeClass('glyphicon-ok');
				}
			}
		});
	}
}

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
