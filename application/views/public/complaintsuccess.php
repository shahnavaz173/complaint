<?php
	if(!$islogin)
		redirect(base_url('login'));

	if(!isset($registered_complaint))
		redirect(base_url('home'));
?>

<div class="container-login col-md-10 col-md-offset-1" style="box-shadow:0px 0px 7px 0px #000;">

	  <div class="row col-md-offset-1" style="padding-top:6em;padding-bottom:6em;">
    <center>
      <h3>Your complaint registered sucessfully</h3>
      <h4>Complaint ID is :<span style="color:red"><?=$registered_complaint; ?></span></h3>
	  </center>
		</div>
</div>
