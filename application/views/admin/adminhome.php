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
							<th class="ctype-row">Type</th>
							<th>Description</th>
							<th>Complaint Location</th>
							<th>Status</th>
							<th class="assign-th">Worker</th>
						</tr>
					<thead>
					<tbody>

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
	$(window).load(function()
	{
		display_complaints('all');
	});

});
function display_complaints(id)
{
	var dataString = 'id='+ id;
	if(id != '')
	{
		$.ajax
		({
			type: "POST",
			url: "<?=base_url('Admin/get_complaint_list'); ?>",
			data: dataString,
			cache: false,
			success: function(data)
			{
				var dataArr = JSON.parse(data);
				if(dataArr.length == 0)
				{
				}
				else
				{
					var chkclass = 'bg-success text-success';
					for(i = 0; i<dataArr.length; i++)
					{
						if(dataArr[i].flag == 0)
						{
							if(dataArr[i].c_status == 'Solved')
								chkclass = 'bg-success text-success';
							else
								chkclass = 'bg-danger text-danger';
						}
						else
						{
							if(dataArr[i].c_status == 'Solved')
								chkclass = 'bg-success text-success';
							else
								chkclass = 'bg-info text-info';
						}
						var worker = "Click To Assign";
						var wclass = "not-assigned"
						if(dataArr[i].w_id != null)
						{
							worker = dataArr[i].w_name;
						}
						else
						{
							wclass = dataArr[i].w_id;
						}
						var html = "";
						if(id != 'all')
						{
							$(".ctype-row").hide()
								html = "\
								<tr class='"+chkclass+" lists'>\
									<td>"+dataArr[i].c_id+"</td>\
									<td>"+dataArr[i].full_name+"</td>\
									<td>"+dataArr[i].c_description+"</td>\
									<td>"+dataArr[i].Dept_Name+" , "+dataArr[i].location+"</td>\
									<td>"+dataArr[i].c_date+" </td>\
									<td>"+dataArr[i].c_status+"</td>\
								<td class = 'worker' style='cursor:pointer;'><input type='hidden' class='cidhidden' value='"+dataArr[i].c_id+"'><input type='hidden' class='wcate' value='"+dataArr[i].cate_id+"'> "+worker+" </td>\
								</tr>";
						}
						else
						{
							$(".ctype-row").show()
							html = "\
							<tr class='"+chkclass+" lists'>\
								<td> "+dataArr[i].c_id+" </td>\
								<td> "+dataArr[i].full_name+" </td>\
								<td> "+dataArr[i].category+" </td>\
								<td> "+dataArr[i].c_description+" </td>\
								<td> "+dataArr[i].location+" </td>\
								<td> "+dataArr[i].c_date+" </td>\
								<td> "+dataArr[i].c_status+" </td>\
								<td class = 'worker' style='cursor:pointer;'><input type='hidden' class='cidhidden' value='"+dataArr[i].c_id+"'><input type='hidden' class='wcate' value='"+dataArr[i].cate_id+"'> "+worker+" </td>\
							</tr>";
						}
						var table = $("#datatable").dataTable();
						var added =	table.fnAddData([
								dataArr[i].c_date,
								dataArr[i].full_name,
								dataArr[i].category,
								dataArr[i].c_description,
								dataArr[i].location,
								"<span class='change status'>"+dataArr[i].c_status+"</status>",
								"<span class = 'worker' style='cursor:pointer;'><input type='hidden' class='cidhidden' value='"+dataArr[i].c_id+"'><input type='hidden' class='wcate' value='"+dataArr[i].cate_id+"'>"+worker+"</span>"
							]);
						var ntr = table.fnSettings().aoData[ added[0] ].nTr;
						ntr.className = chkclass;
						}
					}
				}
		});
	}
}

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
	})
</script>
