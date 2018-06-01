<?php
	if(!$islogin)
		redirect(base_url('login'));
?>

<div class="assign-worker">
	<div class="jumbotron jumbotron-main">
			<h1>Asssign Worker To Complaint</h1>
	</div>
	<div class="row" >
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
			<div class="table-responsive">
				<table class="table  table-bordered complaint-table-worker">
					<thead>
						<tr class="list-head ">
							<th>Date</th>
							<th>Student/Emp Name</th>
							<th>Department</th>
							<th class="ctype-row">Complain Type</th>
							<th>Description</th>
							<th>Location</th>
							<th>Status</th>
							<th>Assigned to</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<?=form_open('Worker/assign_worker',array()); ?>
			<div class="form-row">
				<div class="form-group col-md-6 col-md-offset-3">
					<label for="selectworker">Select Worker: </label>
					<select name="selectworker" class="form-control select-worker" required>
						<option value="">Select Worker</option>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6 col-md-offset-3">
					<input type="submit" class="btn btn-info" value="Click To Assign" >
					<input type="button" class="btn btn-warning cancel-assign" value="Cancel" >
				</div>
			</div>
			<?=form_close(); ?>
		</div>
	</div>
</div>
<div class="container-home">

	<?php /*<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<?=form_open('',array()); ?>
			<div class="form-row">
				<div class="form-group col-md-8 col-md-offset-2">
					<label for="complaintype">Complaint Category: </label>
					<select name="complaintype" class="form-control complaintype">
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
	</div>*/ ?>
	<div class="row" >
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table  table-bordered complaint-table"  id ="datatable" >
					<caption><center><h4>Complaint List</h4></center></caption>
					<thead>
						<tr class="list-head ">
							<th>Date</th>
							<th>User Name</th>
							<th>Department</th>
							<th class="ctype-row">Type</th>
							<th>Description</th>
							<th>Complaint Location</th>
							<th>Status</th>
						</tr>
					<thead>
					<tbody>

						<?php foreach($clist as $datalist):?>

						<tr>
							<td><?php echo $datalist->c_date; ?></td>
							<td><span class='uname'><?=$datalist->full_name; ?></span><span class='cid-name'><br><?=$datalist->ph_no; ?></span></td>
							<td><?=$datalist->Dept_Name; ?></td>
							<td><?=$datalist->category; ?></td>
							<td><?=$datalist->c_description; ?></td>
							<td><?=$datalist->location; ?></td>
							<td><span style='cursor:pointer;' class='change-status'><?=$datalist->c_status; ?></span><input type='hidden' class='cidhidden' value='<?=$datalist->c_id; ?>'></td>
						</tr>
						<?php endforeach; ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
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
<script type="text/javascript">
$(function()
{
		$("#datatable").dataTable();
});
$(document).ready(function()
{
	$(".complaintype").change(function()
	{
		var id=$(this).val();
		display_complaints(id);
	});
	$(".cid-name").hide();
});


$(".complaint-table").on("mouseenter",".uname",function()
{
	$(this).next().show();
});
$(".complaint-table").on("mouseleave",".uname",function()
{
	$(this).next().hide();
});
$(".complaint-table").on("change",".select-status",function()
{
	var stat = $(this).val();
	var cid = $(this).next().val();
	var obj = {status: stat, cid: cid};
	var datastring = 'obj='+JSON.stringify(obj);
	$.ajax
	({
		type: "POST",
		url: "<?=base_url('Complaint/change_status')?>",
		data: datastring,
		cache: false,
		success: function(data)
		{
				$(".select-status").prev('span').text(data);
				$(".select-status").remove();
				$(".change-status").prop("disabled",false);

			if(data.localeCompare("Pending")  == 0)
			{
			}
			else if(data.localeCompare("Under Construction") == 0)
			{
			}
			else if(data.localeCompare("Complete") == 0)
			{
			}
		}
	});
});
$(".complaint-table").on("click",".change-status",function()
{
	var val = $(this).text().trim();
	$(this).text("");
	$(".change-status").prop("disabled",true);
	var html = "<select name='select-status' id='select-status' class='form-control select-status'>\
			<option value='Pending' >Pending</option>\
			<option value='Under Construction'>Under Construction</option>\
			<option value='Complete'>Complete</option>\
		</select>";

	$(this).after(html);
	$(".select-status option").each(function()
	{
		if($(this).val() == val)
		{
			$(this).attr("selected","selected");
		}
	});
});
$(".assign-worker").hide();
$(".complaint-table").on("click",".worker",function()
{
	$(this).parent().parent().clone().appendTo(".complaint-table-worker");
	var cid = $(this).find('.cidhidden').val();
	var wcate = $(this).find('.wcate').val();
	var val = $(this).text();
	if(val.localeCompare("Click To Assign") == 0)
	{

		$(".assign-worker").slideDown("slow");
		$(".container-home").hide();
		//var id = wcate;
		var dataString = 'cate='+ wcate;
		$.ajax
		({
			type: "POST",
			url: "<?=base_url('Worker/get_workers'); ?>",
			data: dataString,
			cache: false,
			success: function(data)
			{
					var wlist = JSON.parse(data);
					for(var i=0;i<wlist.length;i++)
					{
						var option = "<option class='woption' value="+wlist[i].w_id+">"+wlist[i].w_name+"</option";
						$(".select-worker").append(option);
					}
					var hidden = "<input type='hidden' class='woption' name='cid' value='"+cid+"' >";
					$(".select-worker").append(hidden);
			}
		});
	}
});

$(".cancel-assign").click(function()
{
	$(".assign-worker").slideUp("slow");
	$(".container-home").show();
	$(".assign-worker").find("td").remove();
	$(".assign-worker").find("select").find(".woption").remove();
});
</script>
