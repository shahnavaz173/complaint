<div class="container-login">
		<div class="jumbotron jumbotron-main">
			<h1>Login or Track Your Complaint</h1>
		</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-1 lgn" style="background-color:#FFF" >
			<div class="row">
				<div class="jumbotron jumbotron-box">
					<h2>Login</h2>
				</div>
			</div>
			<?=form_open(base_url('Login/validate_login'));?>
			<div class="row utype">
				<div class = "form-group col-md-10 col-md-offset-1 ">
					<label for = "usertype">Select User Type: 	</label>
							<?=form_dropdown('usertype',array('admin' => 'Admin','student' => 'student', 'employee' => 'Employee', 'resident' => 'Resident','worker' => 'Worker'),'Admin',array('class' => 'form-control', 'name'=>'usertype','id' => 'usertype', 'required' => 'true')); ?>
						<div class = "glyphicon  form-control-feedback"></div>

					<!--<h4 class = "bg-danger text-danger error-msg" id = "em-err"><span class = "glyphicon glyphicon-exclamation-sign"></span> Enter Valid E-mail!</h4> -->
				</div>
			</div>

			<div class="row em">
				<div class = "form-group col-md-10 col-md-offset-1 ">
					<label for = "email">E-mail / Enrolment No:
					<div class = "input-group " >
						<div class = "input-group-addon"><i class = "glyphicon glyphicon glyphicon-envelope"></i></div>
						<?=form_input(array('name' => 'email', 'id' => 'email', 'value' => set_value('email'),'placeholder' => 'Enter Enrol/Emp No', 'class' => 'form-control lemail', 'required' => 'true')); ?>
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
					<a href="javascript:forgotPassword()">Forgot Password? Click here...</a>
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
		<div class="col-md-4 col-md-offset-1 frgt" style="background-color:#FFF" >
			<div class="row">
				<div class="jumbotron jumbotron-box">
					<h2>Forgot Password</h2>
				</div>
			</div>
			<?=form_open(base_url('Login/generate_password'));?>

			<div class="row fem">
				<div class = "form-group col-md-10 col-md-offset-1 ">
					<label for = "email">Enter Registered E-mail :
					<div class = "input-group " >
						<div class = "input-group-addon"><i class = "glyphicon glyphicon glyphicon-envelope"></i></div>
						<?=form_input(array('name' => 'email', 'id' => 'femail', 'value' => set_value('email'),'placeholder' => 'Enter E-mail', 'class' => 'form-control femail', 'required' => 'true')); ?>
						<input type="hidden" name="futype" class="futype" >
						<div class = "glyphicon  form-control-feedback"></div>
					</div>
					</label>
					<!--<h4 class = "bg-danger text-danger error-msg" id = "em-err"><span class = "glyphicon glyphicon-exclamation-sign"></span> Enter Valid E-mail!</h4> -->
				</div>
			</div>

			<div  class = "form-group col-md-10 col-md-offset-1">
				<div class="otp-msg">
						<center><p class="bg-success text-success"><b></b></p></center>
				</div>
			</div>
			<div class="row otp-input">
				<div class = "form-group col-md-10 col-md-offset-1 ">
					<label for = "otp">Enter One Time Password :
					<div class = "input-group " >
						<div class = "input-group-addon"><i class = "glyphicon glyphicon glyphicon-lock"></i></div>
						<?=form_input(array('name' => 'otp', 'id' => 'otp','placeholder' => 'Enter 4 Digit OTP', 'class' => 'form-control otp', 'required' => 'true')); ?>
						<input type="hidden" name="otphidden" class="otphidden" >
						<div class = "glyphicon  form-control-feedback"></div>
					</div>
					</label>
					<!--<h4 class = "bg-danger text-danger error-msg" id = "em-err"><span class = "glyphicon glyphicon-exclamation-sign"></span> Enter Valid E-mail!</h4> -->
				</div>
			</div>
			<div class = "row fnext" >
				<div  class = "form-group col-md-10 col-md-offset-1">
						<?=form_button('send','Send OTP',array('id' => 'sendotp','class' => 'btn btn-primary btn-md btn-block form-buttons')); ?>
						<?=form_button('check','Submit OTP',array('id' => 'checkotp','class' => 'btn btn-primary btn-md btn-block form-buttons')); ?>
				</div>
			</div>


			<div class="row npass">
				<div class = "form-group col-md-10 col-md-offset-1 ">
					<label for = "password">Enter New Password:
					<div class = "input-group " >
						<div class = "input-group-addon"><i class = "glyphicon glyphicon glyphicon-lock"></i></div>
						<?=form_input(array('name' => 'npassword', 'id' => 'npassword', 'placeholder' => 'Enter New Password', 'class' => 'form-control', 'required' => 'true', 'type' => 'password')); ?>
						<div class = "glyphicon  form-control-feedback"></div>
					</div>
					</label>
					<!--<h4 class = "bg-danger text-danger error-msg" id = "em-err"><span class = "glyphicon glyphicon-exclamation-sign"></span> Enter Valid E-mail!</h4> -->
				</div>
			</div>
			<div class = "row nsubmit" >
				<div  class = "form-group col-md-10 col-md-offset-1">
						<?=form_submit('submit','Create New Password',array('id' => 'newpwd', 'class' => 'btn btn-primary btn-md btn-block form-buttons')); ?>
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
					<label for="complainid">Enter Complaint id:
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
							<?=form_input(array('name' => 'complainid', 'class' => 'form-control', 'id' => 'complainid', 'placeholder' => 'Enter Complaint Id', 'required' => 'true'));?>
						</div>
					</label>
				</div>
			</div>

			<div  class = "form-group col-md-10 col-md-offset-1">
				<div class="track-err">
						<center><p class="bg-danger text-danger">No Complaint Found Enter Valid Complaint id</p></center>
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
					$(".utype").hide(0);
					$(".em").show(0);
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
<script type="text/javascript">
$(document).ready(function()
{
<?php if($logincheck): ?>
		$(".login-err").show();
<?php else: ?>
		$(".login-err").hide();
<?php endif; ?>


<?php if(!$cdetails): ?>
		$(".track-err").hide();
<?php else: ?>
		$(".track-err").show();
<?php endif; ?>
});
$(".frgt").hide(0);
function forgotPassword()
{

	$(".lgn").hide(0);
	$(".frgt").show(0);
	$(".femail").val($(".lemail").val());
	$(".futype").val($("#usertype").val());
	$(".nsubmit").hide();
	$(".otp-msg").hide();
	$(".otp-input").hide();
	$("#checkotp").hide();
	$(".npass").hide();
}

var limit = 0
$("#sendotp").click(function()
{
	var email = $(".femail").val();
	var utype = $(".futype").val();
	var obj = {email: email, utype: utype};
	var datastring = 'obj='+JSON.stringify(obj);
	$.ajax
	({
		type: "POST",
		url: "<?=base_url('Login/send_otp'); ?>",
		data: datastring,
		cache: false,
		beforeSend: function()
		{
			$(".otp-msg").show();
			$(".otp-msg").find("p").removeClass('bg-success');
			$(".otp-msg").find("p").removeClass('text-success');
			$(".otp-msg").find("p").removeClass('bg-danger');
			$(".otp-msg").find("p").removeClass('text-danger');
			$(".otp-msg").find("p").addClass('bg-info');
			$(".otp-msg").find("p").addClass('text-info');
			$(".otp-msg").find("b").text("Please Wait OTP Will be send to Your E-mail Address...");
		},
		success: function(otp)
		{
			alert(otp);
			$(".otp-input").show();
			$(".otp-msg").find("p").removeClass('bg-info');
			$(".otp-msg").find("p").removeClass('text-info');
			$(".otp-msg").find("p").addClass('bg-success');
			$(".otp-msg").find("p").addClass('text-success');
			$(".otp-msg").find("b").text("OTP Has been send Check your E-mail...");
			$(".fem").hide();
			$("#sendotp").text("Resend OTP");
			$("#checkotp").show();
			$(".otphidden").val(otp);
			limit = 0
		}
	});
});
$("#checkotp").click(function()
{
	if(limit == 3)
	{
		$(".otp-msg").find("b").text("Yo've Reached Maximum try!");
	}
	else
	{
		var otp = $("#otp").val();
		var otphidden = $(".otphidden").val();
		if(otp == otphidden)
		{
			$(".otp-msg").hide();
			$(".otp-input").hide();
			$(".fnext").hide();
			$(".npass").show();
			$(".nsubmit").show();
		}
		else
		{
			limit++;
			$(".otp-msg").find("p").removeClass('bg-success');
			$(".otp-msg").find("p").removeClass('text-success');
			$(".otp-msg").find("p").addClass('bg-danger');
			$(".otp-msg").find("p").addClass('text-danger');
			$(".otp-msg").find("b").text("Invalid OTP Try Again");
		}
	}

});
</script>
