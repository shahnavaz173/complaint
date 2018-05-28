<?php
	if(!$islogin)
		redirect(base_url('login'));
?>
<div class="container-home worker-main">
  <div class="jumbotron jumbotron-main">
		<h1>Common Complaints</h1>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="form-row">
				<div class="form-group col-md-3 ">
					<button class="btn btn-warning click-to-add" ><span class="glyphicon glyphicon-plus"></span> Click To Add New </button>
				</div>
				<?=form_open('',array()); ?>
				<div class="form-group col-md-5 col-md-offset-1">
					<label for="workertype">Category: </label>
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
				<table class="table table-striped table-bordered category-table" id="table" >
					<tr class="list-head ">
            <th>Category</th>
            <th>Complaint Description</th>
            <th>For Whom</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
