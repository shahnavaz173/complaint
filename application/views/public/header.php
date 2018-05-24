<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="icon" href="<?=base_url('assets/images/favicon.ico'); ?>">

	<?=link_tag(base_url('assets/css/bootstrap.min.css'));?>
	<?=link_tag(base_url('assets/css/css-style.css'));?>
	<?=link_tag(base_url('assets/css/datepicker.css'));?>

	<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-2.2.0.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.min.js"></script>

</head>
<body>
<img src="<?=base_url('assets/images/header-bg.jpg'); ?>" width="100%">
<header>
	<nav class = "navbar navbar-default">
		<div class = "container-fluid">
			<div class = "navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse" aria-expanded="false">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?=base_url(); ?>">GVP Complaint	</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse">
				<ul class="nav navbar-nav ">
				<?php	if(strcmp($viewuser,'public') == 0): ?>
						<li role = "presentation" ><a href = "<?=base_url(); ?>" <?php if($title=='Home'){ echo "class='active'"; }?> ><span class = "glyphicon glyphicon-home">	</span> Home</a></li>
					<?php if(!$islogin):?>
						<li role = "presentation" ><a href = "<?=base_url('register'); ?>" <?php if($title=='Register'){ echo "class='active'"; }?>  ><span class = "glyphicon glyphicon-user">	</span> Register</a></li>
						<li role = "presentation" ><a href = "<?=base_url('login'); ?>" <?php if($title=='Login'){ echo "class='active'"; }?>  ><span class = "glyphicon glyphicon-log-in" > </span> Login</a></li>
					<?php else: ?>
						<li role = "presentation" ><a href = "<?=base_url('complaintregister'); ?>" <?php if($title=='Complaintregister'){ echo "class='active'"; }?> ><span class = "glyphicon glyphicon-plus">	</span> Complaint Register</a></li>
					<?php endif; ?>


				<?php 	elseif(strcmp($viewuser,'admin') == 0): ?>
					<li role = "presentation" ><a href = "<?=base_url('admin/adminhome'); ?>" <?php if($title=='Adminhome'){ echo "class='active'"; }?> ><span class = "glyphicon glyphicon-home">	</span> Home</a></li>
					<?php if($islogin):?>
						<li role = "presentation" ><a href = "<?=base_url('admin/worker'); ?>" <?php if($title=='Worker'){ echo "class='active'"; }?> ><span class = "glyphicon glyphicon-user">	</span> Worker</a></li>

					<?php endif; ?>
				<?php endif ?>
					</ul>
				<?php if($islogin):?>
					<ul class="nav navbar-nav" style="float:right;">
							<li role = "presentation" ><a href = "<?=base_url('Login/logout'); ?>" ><span class = "glyphicon glyphicon-log-out">	</span> Logout</a></li>
					</ul>
				<?php endif;	?>

				</ul>
			</div>

		</div>
	</nav>
</header>
<div class="container container-main">
