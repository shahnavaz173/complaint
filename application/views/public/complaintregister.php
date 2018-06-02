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

<div class="container-complaint-registers">

		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12" style="box-shadow:0px 0px 3px 0px #000;border:1px solid #999;background:#F9F7F7;">
				<div class="table-responsive" style="padding:.5em;height:250px;overflow:scroll;">
					<table class="table table-bordered complaint-table" style="background:#eaeaea;" id="datatable">
						<caption><h5><b>Complaints that already registered from your location</b></h5></caption>
						<thead>
							<tr class="list-head ">
								<th>Student/Emp Name</th>
								<th class="ctype-row">Complain Type</th>
								<th>Description</th>
								<th>Location</th>
								<th>Date</th>
								<th>Status</th>
								<th>Assigned to</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($complaints as $complaint): ?>
	              <tr>
									<?php
									switch($complaint->c_status)
									{
										case 1:
											$status = "Open";
										break;
										case 2:
											$status = "Pending";
										break;
										case 3:
											$status = "Under Observation";
										break;
										case 4:
											$status = "Closed But Not Complete";
										break;
										case 5:
											$status = "Closed";
										break;
										case 6:
											$status = "Rejected";
										break;
									}
									?>
									<td><?=$complaint->full_name; ?></td>
									<td><?=$complaint->category; ?></td>
									<td><?=$complaint->c_description; ?></td>
									<td><?=$complaint->location; ?></td>
									<td><?=$complaint->c_date; ?></td>
									<td><?=$status; ?></td>
									<td>
										<?php
										if($complaint->w_name == null)
										 	echo "Not Assigned";
										else
											echo $complaint->w_name;
										?>
									</td>
								</tr>

							<?php endforeach; ?>
						</tbody>

					</table>
				</div>
			</div>
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12" style="box-shadow:0px 0px 3px 0px #000;border:1px solid #999;background:#F9F7F7;margin-top:1em;">
				<?=form_open(base_url('Complaint/register'),array('class' => 'form-register')); ?>
				<div class='row'>
					<div class="form-group has-feedback has-success col-md-8 ">
						<h2>Register Your Complaint</h2>
					</div>
					<div class="form-group has-feedback has-success col-md-6">
						<label for="empnumber">Employee/Enrolment Number: </label>
						<div class="input-group">
							<span class="input-group-addon"> <span class="glyphicon glyphicon-pencil"></span></span>
							<?=form_input(array('class' => 'form-control', 'id' => 'empnumber', 'name' => 'empnumber','readonly' => 'readonly','style' => 'cursor:not-allowed','required' => 'required')); ?>
							<span class="glyphicon glyphicon-ok  form-control-feedback"></span>
						</div>
					</div>
					<div class="form-group has-feedback has-success col-md-6">
						<label for="fullname">Your Full Name: </label>
						<div class="input-group">
							<span class="input-group-addon"> <span class="glyphicon glyphicon-user"></span></span>
							<?=form_input(array('class' => 'form-control', 'id' => 'fullname', 'name' => 'fullname','readonly' => 'readonly','style' => 'cursor:not-allowed','required' => 'required' )); ?>
							<span class="glyphicon glyphicon-ok form-control-feedback"></span>
						</div>
					</div>
					<div class="form-group has-feedback has-success col-md-6">
						<label for="ctype">Select Complaint Type: </label>
						<div class="input-group">
							<span class="input-group-addon"> <span class="glyphicon glyphicon-list"></span></span>
							<select name="complaintype" class="form-control complaintype" required>
								<?php foreach ($complain_caategory as $category): ?>
									<?php if($category->cate_id == $ctype): ?>
										<option value="<?php echo $category->cate_id; ?>" selected><?php echo $category->category; ?></option>
									<?php else: ?>
										<option value="<?php echo $category->cate_id; ?>"><?php echo $category->category; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
							</select>
						</div>
					</div><div class="form-group has-feedback col-md-6">
						<label for="cdescription">Complaint Location: </label>
						<div class="input-group">
							<span class="input-group-addon"> <span class="glyphicon glyphicon-list-alt"></span></span>
							<select name="clocation" class="form-control clocation" required>
								<option value="">Select Location</option>
								<?php if($usertype == "student"): ?>
									<option value="hostel">Hostel</option>
									<option value="department">Department</option>
									<option value="other">Other</option>
								<?php elseif($usertype == "employee"): ?>
									<option value="department">Department</option>
									<option value="residance">Residance</option>
									<option value="other">Other</option>
								<?php else: ?>
									<option value="residance">Residance</option>
									<option value="other">Other</option>
								<?php endif; ?>
							</select>
						</div>
					</div>
					<div class="form-group has-feedback col-md-6">
						<label for="cdescription">Complaint Description: </label>
						<div class="input-group">
							<span class="input-group-addon"> <span class="glyphicon glyphicon-list-alt"></span></span>
							<input list="cdescription" name="cdescription" class="form-control" placeholder="Enter Complaint Description:" autocomplete="off" required>
								<datalist id="cdescription">

								</datalist>
								<span class="glyphicon  form-control-feedback"></span>
						</div>
					</div>

					<div class="form-group has-feedback col-md-6" id="ad2">
						<label for="address">Full Address: (Building No/Room No)</label>
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
								<?=form_textarea(array('class' => 'form-control', 'rows' => '2', 'name' => 'address', 'id' => 'address', 'placeholder' => 'address', 'onkeyup' => 'validateField(this)','onchange' => 'validateField(this)','required' => 'required')); ?>
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
<script type="text/javascript">
$(function()
{
		$("#datatable").dataTable({
			"ordering": false
		});
});
$(document).ready(function()
{
	$(window).load(function()
	{
		var id = <?=$uid; ?>;
		var datastring = 'uid='+id;
		$.ajax
		({
			type: "POST",
			url: "<?=base_url('Site/get_user'); ?>",
			data: datastring,
			cache: false,
			success: function(data)
			{
				var user = JSON.parse(data);
				$("#empnumber").val(user[0].u_id);
				$("#fullname").val(user[0].full_name);
			}
		});
	});
	$(".complaintype").change(function()
	{
		if($(".clocation").val() != "")
		{
			$("datalist").find("option").remove();
			var id = $(this).val();
			var obj = {id: id,  location: $(".clocation").val()};
			var datastring = 'obj='+JSON.stringify(obj);
			$.ajax
			({
				type: "POST",
				url: "<?=base_url('Complaint/get_category'); ?>",
				data: datastring,
				cache: false,
				success: function(data)
				{
					var descriptions = JSON.parse(data);
					for(var i=0;i<descriptions.length;i++)
					{
						$("datalist").append("<option value='"+descriptions[i].description+"'>");
					}
				}
			});
		}

	});
	$(".clocation").change(function()
	{
		$("datalist").find("option").remove();
		var id = $(".complaintype").val();
		var obj = {id: id,  location: $(this).val()};
		var datastring = 'obj='+JSON.stringify(obj);
		$.ajax
		({
			type: "POST",
			url: "<?=base_url('Complaint/get_category'); ?>",
			data: datastring,
			cache: false,
			success: function(data)
			{
				var descriptions = JSON.parse(data);
				for(var i=0;i<descriptions.length;i++)
				{
					$("datalist").append("<option value='"+descriptions[i].description+"'>");
				}
			}
		});
	});
	$(".clocation").change(function()
	{
		if($(this).val().localeCompare('other') != 0)
		{
			var obj = {uid: $("#empnumber").val() ,usertype: '<?=$usertype; ?>', location: $(this).val()};
			var datastring = 'obj='+JSON.stringify(obj);
			$.ajax
			({
				type: "POST",
				url: "<?=base_url('Complaint/get_user_address'); ?>",
				data: datastring,
				cache: false,
				success: function(address)
				{
					$("#address").val(address);
				}
		});
	}
	else
	{
		$("#address").val("");
	}
	});
});
</script>

<style>
.pagination > li > a, .pagination > li > span
{
	background-color:#337ab7 !important;
	opacity:.8;
	margin-left:1px;
}
.pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover
{
		opacity:1;
		background-color:#337ab7 !important;
}
</style>
