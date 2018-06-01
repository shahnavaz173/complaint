<?php
	if(!$islogin)
		redirect(base_url('login'));
?>
<script type="text/javascript" src="<?=base_url();?>assets/js/validation.js"></script>

<div class="row add-new-worker">
	<div class="col-md-8 col-md-offset-2 container-reg">
		<div class="row">
			<div class="jumbotron jumbotron-main">
				<h1>Add New Worker</h1>
			</div>
		</div>
		<?=form_open(base_url('Worker/add_new'),array('class' => 'form-add-worker')); ?>
		<div class='row'>
			<div class="form-group  col-md-6">
				<label for="worker-skill">Select Worker Skil: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-list"></span></span>
					<select name="workerskill" id="worker-skill" class="form-control worker-skill" required>
						<option value="">Select Skill</option>
						<?php foreach ($complain_caategory as $category): ?>
							<option value="<?php echo $category->cate_id; ?>"><?php echo $category->category; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="fullname">Enter Full Name: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-user"></span></span>
					<?=form_input(array('class' => 'form-control', 'id' => 'fullname', 'name' => 'fullname', 'placeholder' => 'Enter Full Name', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)', 'required' => 'true' )); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="fn" ></p>
			</div>
		</div>
		<div class="row">
			<div class="form-group has-feedback col-md-6">
				<label for="email">Enter E-mail Address: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
					<input type="email" class="form-control" id="email" name="email" placeholder="Enter E-mail" onkeyup="validateField(this)" onchange="validateField(this)" required />
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="em" ></p>
			</div>
			<div class="form-group has-feedback col-md-6">
				<label for="contact">Enter Contact Number: </label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></div>
					<?=form_input(array('class' => 'form-control', 'id' => 'contact', 'name' => 'contact', 'placeholder' => 'Enter Contact No', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)', 'required' => 'true' )); ?>
					<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" id="ph" ></p>
			</div>
		</div>
		<div class="row">
			<div class="form-group has-feedback col-md-6">
				<label for="address">Enter Address:</label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
						<?=form_textarea(array('class' => 'form-control', 'rows' => '2', 'name' => 'address', 'id' => 'address', 'placeholder' => 'address', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)', 'required' => 'true')); ?>
						<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" ></p>
			</div>
			<div class="form-group col-md-6">
				<label for="status">Status:</label>
					<div class="radio">
						<?=form_radio(array('class' => 'status', 'id' => 'statusa', 'name' => 'status', 'required' => 'true'),'Active','checked'); ?>: Active
					</div>
					<div class="radio">
						<?=form_radio(array('class' => 'gender', 'id' => 'statusn', 'name' => 'status', 'required' => 'true'	),'Not Active'); ?>: Not Active
					</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group has-feedback col-md-6">
				<label for="password">Enter Password:</label>
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
						<?=form_input(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Enter Password', 'class' => 'form-control', 'required' => 'true', 'type' => 'password', 'onkeyup' => 'validateField(this)')); ?>
						<span class="glyphicon  form-control-feedback"></span>
				</div>
				<p class="bg-danger text-danger validation-error" ></p>
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
					<?=form_reset('button','Cancel',array('class' => 'btn btn-primary btn-lg btn-block form-buttons cancel-add-worker')); ?>
			</div>
		</div>

		<?=form_close(); ?>
	</div>
</div>
