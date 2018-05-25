<?php
	if(!$islogin)
		redirect(base_url('login'));
?>
<div class="container-home worker-main">
  <div class="jumbotron jumbotron-main">
		<h1>Workers</h1>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="form-row">
				<div class="form-group col-md-3 ">
					<button class="btn btn-warning click-to-add" ><span class="glyphicon glyphicon-plus"></span> Click To Add Worker </button>
				</div>
				<?=form_open('',array()); ?>
				<div class="form-group col-md-5 col-md-offset-1">
					<label for="workertype">Worker Skill: </label>
					<select name="workertype" class="form-control worker-type">
						<option value="">Select Category</option>
						<option value="all">All</option>
						<?php foreach ($complain_caategory as $category): ?>
							<option value="<?php echo $category->cate_id; ?>"><?php echo $category->category; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<?=form_close(); ?>
		</div>
	</div>
	<div class="row" >
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered worker-table" id="table" >
					<tr class="list-head ">
							<th>Worker Name</th>
							<th>Phone Number</th>
							<th>E-mail</th>
							<th>Address</th>
							<th class="skill-row">Skill</th>
							<th>Status(Click to Change)</th>
							<th>Update</th>
							<th>Delete</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
include	("workerjs.php");
include	("add-worker.php");
?>
