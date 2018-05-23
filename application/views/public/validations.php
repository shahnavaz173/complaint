<script type='text/javascript' >
$(document).ready(function()
{
  <?php
  echo "yes";
  if($valid==1)
  {?>
      $(".input-group").addClass('has-success');
			$(".form-control-feedback").addClass('glyphicon-ok');
			$("#password").parent().addClass('has-error');
			$("#password").next().addClass('glyphicon-warning-sign');
			$("#cpassword").parent().addClass('has-error');
			$("#cpassword").next().addClass('glyphicon-warning-sign');
  <?php
  }
  if(form_error('fullname'))
	{
  ?>
      $("#fullnmae").parentsUntil('.form-group').removeClass('has-success');
      $("#fullname").parentsUntil('.form-group').addClass('has-error');
      $("#fullname").next('span').addClass('glyphicon-warning-sign');
      $("#fn").parent().next('.validation-error').html(<?php echo form_error('fullname'); ?>);
      $("#fullname").next('span').removeClass('glyphicon-ok');
	<?php
  }
  if(form_error('empnumber'))
  {
  ?>
      $("#empnumber").parentsUntil('.form-group').removeClass('has-success');
      $("#empnumber").parentsUntil('.form-group').addClass('has-error');
      $("#empnumber").next('span').addClass('glyphicon-warning-sign');
      $("#en").parent().next('.validation-error').html(<?php echo form_error('empnumber'); ?>);
      $("#empnumber").next('span').removeClass('glyphicon-ok');

  <?php
  }
  if(form_error('email'))
  {
  ?>
    $("#email").parentsUntil('.form-group').removeClass('has-success');
    $("#email").parentsUntil('.form-group').addClass('has-error');
    $("#email").next('span').addClass('glyphicon-warning-sign');
    $("#em").parent().next('.validation-error').html(<?php echo form_error('email'); ?>);
    $("#email").next('span').removeClass('glyphicon-ok');

  <?php
  }
  if(form_error('contact'))
  {
  ?>
    $("#contact").parentsUntil('.form-group').removeClass('has-success');
    $("#contact").parentsUntil('.form-group').addClass('has-error');
    $("#contact").next('span').addClass('glyphicon-warning-sign');
    $("#ph").parent().next('.validation-error').html(<?php echo form_error('email'); ?>);
    $("#contact").next('span').removeClass('glyphicon-ok');
  <?php
  }
  if(form_error('password'))
  {
  ?>
    $("#password").parentsUntil('.form-group').removeClass('has-success');
    $("#password").parentsUntil('.form-group').addClass('has-error');
    $("#password").next('span').addClass('glyphicon-warning-sign');
    $("#pwd").parent().next('.validation-error').html(<?php echo form_error('email'); ?>);
    $("#password").next('span').removeClass('glyphicon-ok');

  <?php
  }
  if(form_error('cpassword'))
  {
  ?>
  $("#cpassword").parentsUntil('.form-group').removeClass('has-success');
  $("#cpassword").parentsUntil('.form-group').addClass('has-error');
  $("#cpassword").next('span').addClass('glyphicon-warning-sign');
  $("#cpwd").parent().next('.validation-error').html(<?php echo form_error('email'); ?>);
  $("#cpassword").next('span').removeClass('glyphicon-ok');
  
  <?php
  }
  ?>


});
</script>
<?php
include("validations.php");
 ?>
