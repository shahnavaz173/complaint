<?php
	if(!$islogin)
		redirect(base_url('login'));
?>
<script type="text/javascript">
$(document).ready(function()
{
	$("tr:odd").addClass('bg-info');
	$("tr:odd").addClass('text-info');
	$("tr:even").css('background','#F9F7F7');
});

</script>
<div class="container-login">
		<div class="jumbotron jumbotron-main">
			<h1>Register Your Complaint</h1>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12" style="box-shadow:0px 0px 3px 0px #000;border:1px solid #999;background:#F9F7F7;">
				<div class="table-responsive" style="padding:.5em;height:220px;overflow:scroll;">
					<table class="table table-bordered complaint-table" style="background:#eaeaea;" >
						<caption><h2>Complaints that already registered from your location</h2></caption>
						<tr class="list-head ">
							<th>Complain id</th>
							<th>Student/Emp Name</th>
							<th class="ctype-row">Complain Type</th>
							<th>Description</th>
							<th>Location</th>
							<th>Date</th>
							<th>Status</th>
							<th>Assigned to</th>
						</tr>
						<tr>
							<td>1234567891</td>
							<td>Shahnawaz S Saiyad</td>
							<td>Electrical</td>
							<td>Fan Not Working</td>
							<td>Post Graduation Boys Hostel Room No 29</td>
							<td>2018-05-10</td>
							<td>Pending</td>
							<td>Ramesh Bhai</td>
						</tr>
						<tr>
							<td>1234567891</td>
							<td>Shahnawaz S Saiyad</td>
							<td>Electrical</td>
							<td>Fan Not Working</td>
							<td>Post Graduation Boys Hostel Room No 29</td>
							<td>2018-05-10</td>
							<td>Pending</td>
							<td>Ramesh Bhai</td>
						</tr>
						<tr>
							<td>1234567891</td>
							<td>Shahnawaz S Saiyad</td>
							<td>Electrical</td>
							<td>Fan Not Working</td>
							<td>Post Graduation Boys Hostel Room No 29</td>
							<td>2018-05-10</td>
							<td>Pending</td>
							<td>Ramesh Bhai</td>
						</tr>
						<tr>
							<td>1234567891</td>
							<td>Shahnawaz S Saiyad</td>
							<td>Electrical</td>
							<td>Fan Not Working</td>
							<td>Post Graduation Boys Hostel Room No 29</td>
							<td>2018-05-10</td>
							<td>Pending</td>
							<td>Ramesh Bhai</td>
						</tr>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12" style="box-shadow:0px 0px 3px 0px #000;border:1px solid #999;background:#F9F7F7;margin-top:1em;">
				<?=form_open(base_url('validation/register'),array('class' => 'form-register')); ?>
				<div class='row'>
					<div class="form-group has-feedback has-success col-md-8 ">
						<h2>Register Your Complaint</h2>
					</div>
					<div class="form-group has-feedback has-success col-md-6">
						<label for="empnumber">Employee/Enrolment Number: </label>
						<div class="input-group">
							<span class="input-group-addon"> <span class="glyphicon glyphicon-pencil"></span></span>
							<?=form_input(array('class' => 'form-control','value' => '11708118', 'id' => 'empnumber', 'name' => 'empnumber','readonly' => 'readonly','style' => 'cursor:not-allowed')); ?>
							<span class="glyphicon glyphicon-ok  form-control-feedback"></span>
						</div>
					</div>
					<div class="form-group has-feedback has-success col-md-6">
						<label for="fullname">Your Full Name: </label>
						<div class="input-group">
							<span class="input-group-addon"> <span class="glyphicon glyphicon-user"></span></span>
							<?=form_input(array('class' => 'form-control','value' => 'Shahnawaz S Saiyad', 'id' => 'fullname', 'name' => 'fullname','readonly' => 'readonly','style' => 'cursor:not-allowed' )); ?>
							<span class="glyphicon glyphicon-ok form-control-feedback"></span>
						</div>
					</div>
					<div class="form-group has-feedback has-success col-md-6">
						<label for="ctype">Select Complaint Type: </label>
						<div class="input-group">
							<span class="input-group-addon"> <span class="glyphicon glyphicon-list"></span></span>
							<select name="complaintype" class="form-control complaintype">
								<option value="">Select Category</option>
								<option value="all">All</option>
								<?php foreach ($complain_caategory as $category): ?>
									<?php if($category->cate_id == 1): ?>
										<option value="<?php echo $category->cate_id; ?>" selected><?php echo $category->category; ?></option>
									<?php else: ?>
										<option value="<?php echo $category->cate_id; ?>"><?php echo $category->category; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group has-feedback col-md-6">
						<label for="cdescription">Complaint Description: </label>
						<div class="input-group">
							<span class="input-group-addon"> <span class="glyphicon glyphicon-list-alt"></span></span>
							<input list="cdescription" name="cdescription" class="form-control" placeholder="Enter Complaint Description:">
								<datalist id="cdescription">
										<option value = "Fan Not Working">
								</datalist>
								<span class="glyphicon  form-control-feedback"></span>
						</div>
					</div>
					<div class="form-group has-feedback col-md-6">
						<label for="cdescription">Complaint Location: </label>
						<div class="input-group">
							<span class="input-group-addon"> <span class="glyphicon glyphicon-list-alt"></span></span>
							<select name="clocation" class="form-control">
								<option value="">Select Location</option>
								<option value="hostel">Hostel</option>
								<option value="department">Department</option>
								<option value="department">Residance</option>
								<option value="other">Other</option>
							</select>
						</div>
					</div>
					<div class="form-group has-feedback col-md-6" id="ad2">
						<label for="address">Full Address: (Building No/Room No)</label>
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
								<?=form_textarea(array('class' => 'form-control', 'rows' => '2', 'name' => 'address', 'id' => 'address', 'placeholder' => 'address', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)')); ?>
								<span class="glyphicon  form-control-feedback"></span>
						</div>
						<p class="bg-danger text-danger validation-error" ></p>
					</div>
				</div>
						<div class = "row" >
							<div  class = "form-group col-md-6">
									<?=form_submit('submit','Submit',array('class' => 'btn btn-primary btn-lg btn-block form-buttons', 'id' => 'submit')); ?>
							</div>
							<div  class = "form-group col-md-6">
									<?=form_reset('reset','Reset',array('class' => 'btn btn-primary btn-lg btn-block form-buttons')); ?>
							</div>
						</div>
						<?=form_close(); ?>
			</div>

		</div>
</div>
