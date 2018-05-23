<?php
if($islogin)
	redirect(base_url()."admin/adminhome");
?>
<div class="container-login">
		<div class="jumbotron jumbotron-main">
			<h1>Admin Login</h1>
		</div>
	<div class="row">

		<div class="col-md-4 col-md-offset-4" style="background-color:#FFF" >
			<div class="row">
				<div class="jumbotron jumbotron-box">
					<h2>Login</h2>
				</div>
			</div>
			<?=form_open(base_url().'Admin/login');?>
			<div class="row em">
				<div class = "form-group col-md-10 col-md-offset-1 ">
					<label for = "email">E-mail :
					<div class = "input-group " >
						<div class = "input-group-addon"><i class = "glyphicon glyphicon glyphicon-envelope"></i></div>
						<?=form_input(array('name' => 'email', 'id' => 'email', 'value' => set_value('email'),'placeholder' => 'Enter E-mail', 'class' => 'form-control', 'required' => 'true')); ?>
						<div class = "glyphicon  form-control-feedback"></div>
					</div>
					</label>
					<!--<h4 class = "bg-danger text-danger error-msg" id = "em-err"><span class = "glyphicon glyphicon-exclamation-sign"></span> Enter Valid E-mail!</h4> -->
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
				<div  class = "form-group col-md-10 col-md-offset-1">
					<div class="login-err">
							<center><p class="bg-danger text-danger">Invalid Login Details</p></center>
					</div>
				</div>
			</div>
			<div class = "row submit" >
				<div  class = "form-group col-md-10 col-md-offset-1">
						<?=form_submit('login','Login',array('id' => 'submit', 'class' => 'btn btn-primary btn-md btn-block form-buttons')); ?>
				</div>
			</div>
			<?=form_close();?>
		</div>

	</div>
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
