<?php
	if(!$islogin)
		redirect(base_url('login'));
?>
<div class="container-home worker-main">
	<div class="row">
		<div class="col-md-12">
			<div class="form-row">
				<div class="form-group col-md-2 col-md-offset-10">
					<button class="btn btn-warning click-to-add" ><span class="glyphicon glyphicon-plus"></span> Click To Add Worker </button>
				</div>
			</div>
			<?=form_close(); ?>
		</div>
	</div>
	<div class="row" >
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered worker-table"  id ="datatable" >
					<caption><center><b>Workers</b></center></caption>
					<thead>
						<tr class="list-head ">
							<th>Name</th>
							<th>Phone</th>
							<th>E-mail</th>
							<th>Address</th>
							<th class="skill-row" style="width:1em">Skill</th>
							<th style="width:1em">Status</th>
							<th style="width:1em">Update</th>
							<th style="width:1em">Delete</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function()
	{
			var table = $("#datatable").dataTable({
					"ordering": false
				});
	});
</script>
<?php
include	("add-worker.php");
include	("workerjs.php");
?>
