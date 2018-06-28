
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
						<?=form_dropdown('usertype',array('' => 'Select user type','employee' => 'Employee', 'recident' => 'Recident'),set_value('usertype'),array('class' => 'form-control', 'id' => 'usertype', 'required' => 'required')); ?>
				</div>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="fullname">Enter Your Full Name: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-user"></span></span>
					<?=form_input(array('class' => 'form-control', 'id' => 'fullname', 'name' => 'fullname', 'placeholder' => 'Enter Full Name', 'value' => set_value('fullname'), 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)', 'autocomplete' => 'off', 'required' => 'required' )); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="fn" >
					<script type="text/javascript">
						<?php if(form_error('fullname')): ?>
							$("#fullname").parentsUntil('.form-group').removeClass('has-success');
							$("#fullname").parentsUntil('.form-group').addClass('has-error');
							$("#fullname").next('span').addClass('glyphicon-warning-sign');
							$("#fullname").parent().next('.validation-error').html("<?=form_error('fullname'); ?>");
							$("#fullname").next('span').removeClass('glyphicon-ok');
						<?php elseif(!empty(set_value('fullname'))): ?>
						$("#fullname").parentsUntil('.form-group').removeClass('has-error');
						$("#fullname").parentsUntil('.form-group').addClass('has-success');
						$("#fullname").next('span').addClass('glyphicon-ok');
						$("#fullname").parent().next('.validation-error').html(null);
						$("#fullname").next('span').removeClass('glyphicon-warning-sign');
					<?php endif; ?>
					</script>
				</p>
			</div>
		</div>
		<div class='row'>
			<div class="form-group  col-md-6">
				<label for="department">Enter Department: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-list"></span></span>
						<select name="department" id="department" class="form-control selectpicker" data-live-search="true" required>
							<?php foreach($departments as $d): ?>
								<?php if($d->deptid ==  set_value('department')): ?>
									<option style="color:#000 !important" value="<?= $d->deptid;?>" selected><?= $d->Dept_Name;?></option>
								<?php else: ?>
									<option style="color:#000 !important" value="<?= $d->deptid;?>"><?= $d->Dept_Name;?></option>
								<?php endif; ?>

							<?php endforeach; ?>
						</select>
				</div>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="empnumber">Enter Employee Number: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-pencil"></span></span>
					<?=form_input(array('class' => 'form-control', 'id' => 'empnumber', 'name' => 'empnumber','value' => set_value('empnumber'), 'placeholder' => 'Enter Employee Number','onkeyup' => 'validateField(this)','onchange' => 'validateUnique(this)','autocomplete' => 'off',  'required' => 'required' )); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="en" >
					<script type="text/javascript">
						<?php if(form_error('empnumber')): ?>
							$("#empnumber").parentsUntil('.form-group').removeClass('has-success');
							$("#empnumber").parentsUntil('.form-group').addClass('has-error');
							$("#empnumber").next('span').addClass('glyphicon-warning-sign');
							$("#empnumber").parent().next('.validation-error').html("<?=form_error('empnumber'); ?>");
							$("#empnumber").next('span').removeClass('glyphicon-ok');
						<?php elseif(!empty(set_value('empnumber'))): ?>
						$("#empnumber").parentsUntil('.form-group').removeClass('has-error');
						$("#empnumber").parentsUntil('.form-group').addClass('has-success');
						$("#empnumber").next('span').addClass('glyphicon-ok');
						$("#empnumber").parent().next('.validation-error').html(null);
						$("#empnumber").next('span').removeClass('glyphicon-warning-sign');
					<?php endif; ?>
					</script>
				</p>
			</div>
		</div>

		<div class="row">
			<div class="form-group has-feedback col-md-6">
				<label for="email">Enter E-mail Address: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
					<?=form_input(array('class' => 'form-control', 'id' => 'email', 'name' => 'email','value' => set_value('email'), 'placeholder' => 'Enter E-mail', 'onkeyup'=> 'validateField(this)','onchange' => 'validateUnique(this)', 'autocomplete' => 'off',  'required' => 'required' )); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="em" >
					<script type="text/javascript">
						<?php if(form_error('email')): ?>
							$("#email").parentsUntil('.form-group').removeClass('has-success');
							$("#email").parentsUntil('.form-group').addClass('has-error');
							$("#email").next('span').addClass('glyphicon-warning-sign');
							$("#email").parent().next('.validation-error').html("<?=form_error('email'); ?>");
							$("#email").next('span').removeClass('glyphicon-ok');
						<?php elseif(!empty(set_value('email'))): ?>
							$("#email").parentsUntil('.form-group').removeClass('has-error');
							$("#email").parentsUntil('.form-group').addClass('has-success');
							$("#email").next('span').addClass('glyphicon-ok');
							$("#email").parent().next('.validation-error').html(null);
							$("#email").next('span').removeClass('glyphicon-warning-sign');
					<?php endif; ?>
					</script>
				</p>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="contact">Enter Contact Number: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>
					<?=form_input(array('class' => 'form-control', 'id' => 'contact', 'name' => 'contact','value' => set_value('contact'), 'placeholder' => 'Enter Contact No', 'onkeyup' => 'validateField(this)','onchange' => 'validateUnique(this)', 'autocomplete' => 'off',  'required' => 'required')); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="ph" >
					<script type="text/javascript">
						<?php if(form_error('contact')): ?>
							$("#contact").parentsUntil('.form-group').removeClass('has-success');
							$("#contact").parentsUntil('.form-group').addClass('has-error');
							$("#contact").next('span').addClass('glyphicon-warning-sign');
							$("#contact").parent().next('.validation-error').html("<?=form_error('contact'); ?>");
							$("#contact").next('span').removeClass('glyphicon-ok');
						<?php elseif(!empty(set_value('contact'))): ?>
							$("#contact").parentsUntil('.form-group').removeClass('has-error');
							$("#contact").parentsUntil('.form-group').addClass('has-success');
							$("#contact").next('span').addClass('glyphicon-ok');
							$("#contact").parent().next('.validation-error').html(null);
							$("#contact").next('span').removeClass('glyphicon-warning-sign');
					<?php endif; ?>
					</script>
				</p>
			</div>
		</div>
		<div class="row" >
			<div class="form-group has-feedback col-md-6" id="ad1">
				<label for="address">Enter Office Address: (Office No/Room No)</label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
						<?=form_textarea(array('class' => 'form-control', 'rows' => '2', 'name' => 'oaddress','value' => set_value('oaddress'), 'id' => 'oaddress', 'placeholder' => 'Office address', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)',  'required' => 'required')); ?>
						<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" >
					<script type="text/javascript">
						<?php if(form_error('oaddress')): ?>
							$("#oaddress").parentsUntil('.form-group').removeClass('has-success');
							$("#oaddress").parentsUntil('.form-group').addClass('has-error');
							$("#oaddress").next('span').addClass('glyphicon-warning-sign');
							$("#oaddress").parent().next('.validation-error').html("<?=form_error('oaddress'); ?>");
							$("#oaddress").next('span').removeClass('glyphicon-ok');
						<?php elseif(!empty(set_value('oadress'))): ?>
							$("#oaddress").parentsUntil('.form-group').removeClass('has-error');
							$("#oaddress").parentsUntil('.form-group').addClass('has-success');
							$("#oaddress").next('span').addClass('glyphicon-ok');
							$("#oaddress").parent().next('.validation-error').html(null);
							$("#oaddress").next('span').removeClass('glyphicon-warning-sign');
					<?php endif; ?>
					</script>
				</p>
			</div>

			<div class="form-group  has-feedback col-md-6" id="ad2">
				<label for="address">Enter Address: (Building No/Room No)</label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
						<?=form_textarea(array('class' => 'form-control', 'rows' => '2', 'name' => 'address','value' => set_value('address'), 'id' => 'address', 'placeholder' => 'address', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)')); ?>
						<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" >
					<script type="text/javascript">
						<?php if(!empty(set_value('aadress'))): ?>
							$("#oaddress").parentsUntil('.form-group').removeClass('has-error');
							$("#oaddress").parentsUntil('.form-group').addClass('has-success');
							$("#oaddress").next('span').addClass('glyphicon-ok');
							$("#oaddress").parent().next('.validation-error').html(null);
							$("#oaddress").next('span').removeClass('glyphicon-warning-sign');
					<?php endif; ?>
				</script>
			</p>
			</div>
		</div>
		<div class="row">
			<div class="form-group has-feedback  col-md-6">
				<label>Select profile Photo:</label>
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-warning ">
							Browse&hellip; <input type="file" id="file"  style="display:none;">
						</span>
					</label><input type="text" name="filename"  id="filename" value="<?=set_value('profilephoto'); ?>" class="form-control" readonly>
				</div>
				<p class="bg-danger text-danger validation-error img-err" >
					<?php if(!empty(set_value('profilephoto'))):	?>
							<input type='hidden' name='profilephoto' value="<?=set_value('profilephoto'); ?>" />
					<?php endif; ?>
				</p>
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
				<p class="bg-danger text-danger validation-error" id="pwd" >
					<script type="text/javascript">
						<?php if(form_error('password')): ?>
							$("#password").parentsUntil('.form-group').removeClass('has-success');
							$("#password").parentsUntil('.form-group').addClass('has-error');
							$("#password").next('span').addClass('glyphicon-warning-sign');
							$("#password").parent().next('.validation-error').html("<?=form_error('password'); ?>");
							$("#password").next('span').removeClass('glyphicon-ok');

					<?php endif; ?>
					</script>
			</p>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="cpassword">Confirm Password: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
					<?=form_password(array('name' => 'cpassword', 'class' => 'form-control', 'id' => 'cpassword','placeholder' => 'Confirm Password','onkeyup' => 'validate_pwd(this)',  'required' => 'required')); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="cpwd" >
					<script type="text/javascript">
						<?php if($cpass == 0): ?>
							$("#cpassword").parentsUntil('.form-group').removeClass('has-success');
							$("#cpassword").parentsUntil('.form-group').addClass('has-error');
							$("#cpassword").next('span').addClass('glyphicon-warning-sign');
							$("#cpassword").parent().next('.validation-error').html("<?=form_error('cpassword'); ?>");
							$("#cpassword").next('span').removeClass('glyphicon-ok');
						<?php elseif(form_error('cpassword')): ?>
							$("#cpassword").parentsUntil('.form-group').removeClass('has-success');
							$("#cpassword").parentsUntil('.form-group').addClass('has-error');
							$("#cpassword").next('span').addClass('glyphicon-warning-sign');
							$("#cpassword").parent().next('.validation-error').html("Confirm Password Should be same as Password");
							$("#cpassword").next('span').removeClass('glyphicon-ok');
						<?php endif; ?>
					</script>
		</p>
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
<?php
 ?>
