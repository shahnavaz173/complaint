<div class="container-login">
		<div class="jumbotron jumbotron-main">
			<h1>Login or Track Your Complaint</h1>
		</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-1" style="background-color:#FFF" >
			<div class="row">
				<div class="jumbotron jumbotron-box">
					<h2>Login</h2>
				</div>
			</div>
			<?=form_open(base_url('Login/validate_login'));?>
			<div class="row">
				<div class = "form-group col-md-10 col-md-offset-1 ">
					<label for = "usertype">Select User Type: 	</label>
							<?=form_dropdown('usertype',array('admin' => 'Admin','student' => 'student', 'employee' => 'Employee', 'resident' => 'Resident'),'Admin',array('class' => 'form-control', 'name'=>'usertype','id' => 'usertype', 'required' => 'true')); ?>
						<div class = "glyphicon  form-control-feedback"></div>

					<!--<h4 class = "bg-danger text-danger error-msg" id = "em-err"><span class = "glyphicon glyphicon-exclamation-sign"></span> Enter Valid E-mail!</h4> -->
				</div>
			</div>

			<div class="row em">
				<div class = "form-group col-md-10 col-md-offset-1 ">
					<label for = "email">E-mail / Enrolment No:
					<div class = "input-group " >
						<div class = "input-group-addon"><i class = "glyphicon glyphicon glyphicon-envelope"></i></div>
						<?=form_input(array('name' => 'email', 'id' => 'email', 'value' => set_value('email'),'placeholder' => 'Enter Enrol/Emp No', 'class' => 'form-control', 'required' => 'true')); ?>
						<div class = "glyphicon  form-control-feedback"></div>
					</div>
					</label>
					<!--<h4 class = "bg-danger text-danger error-msg" id = "em-err"><span class = "glyphicon glyphicon-exclamation-sign"></span> Enter Valid E-mail!</h4> -->
				</div>
			</div>
			<div  class = "form-group col-md-10 col-md-offset-1">
				<div class="em-err">
						<center><p class="bg-danger text-danger">You Must Enter E-mail/Enrolment No</p></center>
				</div>
			</div>
			<div class="row pass">
				<div class = "form-group col-md-10 col-md-offset-1 ">
					<label for = "password">Password:
					<div class = "input-group " >
						<div class = "input-group-addon"><i class = "glyphicon glyphicon glyphicon-lock"></i></div>
						<?=form_input(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Enter Password', 'class' => 'form-control', 'required' => 'true', 'type' => 'password')); ?>
						<div class = "glyphicon  form-control-feedback"></div>
					</div>
					</label>
					<!--<h4 class = "bg-danger text-danger error-msg" id = "em-err"><span class = "glyphicon glyphicon-exclamation-sign"></span> Enter Valid E-mail!</h4> -->
				</div>
				<div  class = "form-group col-md-10 col-md-offset-1">
					<a href="">Forgot Password? Click here...</a>
				</div>
			</div>



			<div class = "row next" >
				<div  class = "form-group col-md-10 col-md-offset-1">
						<?=form_button('next','Next',array('id' => 'next','class' => 'btn btn-primary btn-md btn-block form-buttons')); ?>
				</div>
			</div>
			<div class = "row submit" >
				<div  class = "form-group col-md-10 col-md-offset-1">
						<?=form_submit('login','Login',array('id' => 'submit', 'class' => 'btn btn-primary btn-md btn-block form-buttons')); ?>
				</div>
			</div>

			<div  class = "form-group col-md-10 col-md-offset-1">
				<div class="login-err">
						<center><p class="bg-danger text-danger">Invalid Login Details</p></center>
				</div>
			</div>

			<?=form_close();?>
		</div>
		<div class="col-md-4 col-md-offset-2"  style="background-color:#FFF">
			<div class="row">
				<div class="jumbotron jumbotron-box">
					<h2>Track Complaint</h2>
				</div>
			</div>
			<?=form_open('Complaint/track');?>
			<div class="row">
				<div class="form-group col-md-10 col-md-offset-1">
					<label for="complainid">Enter Complain id:
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
							<?=form_input(array('name' => 'complainid', 'class' => 'form-control', 'id' => 'complainid', 'placeholder' => 'Enter Complain Id', 'required' => 'true'));?>
						</div>
					</label>
				</div>
			</div>
			<div class = "row" >
				<div  class = "form-group col-md-10 col-md-offset-1">
						<?=form_submit('track','Track',array('class' => 'btn btn-primary btn-md btn-block form-buttons')); ?>
				</div>
			</div>
			<?=form_close(); ?>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$(".pass").hide(0);
			$(".em-err").hide(0);
			$("#submit").hide(0);
			$("#next").click(function()
			{
				if($("#email").val() != "")
				{
					$(".em").hide(0);
					$(".em-err").hide(0);
					$("#next").hide(0);
					$(".pass").show(0);
					$("#submit").show(0);
				}
				else
				{
					$(".em-err").show(0);
				}

			});
		});

	</script>

</div>
<?php if($logincheck): ?>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$(".login-err").show();
		});
	</script>
<?php else: ?>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$(".login-err").hide();
		});
	</script>
<?php endif; ?>
