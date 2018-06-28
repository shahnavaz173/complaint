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
				<div class="form-row col-md-8">
					<div class="form-group col-md-8 col-md-offset-3">
						<label for="selectworker">Select Worker: </label>
						<select name="selectworker" class="form-control select-worker" required>
							<option value="1">Select Worker</option>
						</select>
					</div>
				</div>
				<div class="form-row col-md-8 ">
					<div class = "form-group col-md-8 col-md-offset-3">
						<label for = "remark">Add Remark:
						<div class = "input-group " >
							<textarea name="remark" id="remark" rows="3" cols="40" class="form-control" placeholder="You must have to solave this complaint in 1 hour"></textarea>
						</div>
						</label>
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

							if(dataArr[i].c_status == 0 )
							{
								chkclass = 'bg-danger text-danger';
								var status = 'Rejected';
							}
							else if(dataArr[i].c_status == 1 )
							{
								chkclass = 'bg-danger text-danger';
								var status = 'Open';
							}
							else if ( dataArr[i].c_status == 2)
							{
									chkclass = 'bg-danger text-danger';
									var status = 'Pending';
							}
							else if(dataArr[i].c_status == 3)
							{
								chkclass = 'bg-warning text-warning';
								var status = "Under Observation";
							}
							else if ( dataArr[i].c_status == 4)
							{
								chkclass = 'bg-warning text-warning';
								var status = "Closed But Not Complete";
							}
							else
							{
								chkclass = 'bg-success text-success';
								var status = "Closed";

							}
						var worker = "Click To Assign";
						var wclass = "not-assigned";
						if(dataArr[i].c_status == 0)
						{
							worker = "Rejected Complaint"
						}
						else if(dataArr[i].w_id != null)
						{
							worker = dataArr[i].w_name;
						}
						else
						{
							wclass = dataArr[i].w_id;
						}
						var table = $("#datatable").dataTable();
						var added =	table.fnAddData([
								dataArr[i].c_date,
								"<span class='uname'>"+dataArr[i].full_name+"</span><br /><span class='cid-name'><br><input type='hidden' class='user-hidden'  value='<?=base_url('assets/images/uploads/'); ?>"+dataArr[i].user_photo+"'></span>",
								dataArr[i].Dept_Name,
								dataArr[i].category,
								dataArr[i].c_description,
								dataArr[i].location,
								"<span style='cursor:pointer;' class='change-status'>"+status+"</span><input type='hidden' class='cidhidden' value='"+dataArr[i].c_id+"'>",
								"<span class = 'worker' style='cursor:pointer;'><input type='hidden' class='cidhidden' value='"+dataArr[i].c_id+"'><input type='hidden' class='wcate' value='"+dataArr[i].cate_id+"'>"+worker+"</span>"
							]);
						var ntr = table.fnSettings().aoData[ added[0] ].nTr;
						ntr.className = chkclass;
						$(".cid-name").hide();

						}
					}
				}
		});
	}
}
$("#datatable").on("mouseenter","td",function()
{
	var src = $(this).find(".cid-name").find('.user-hidden').val();
	if(src != undefined)
	{
		$(this).find('.user-photo').remove();
		$(this).append("<img class='user-photo' src='"+src+"' height='100' width='80'>");
	}
});
$("#datatable").on("mouseleave","td",function()
{
		var src = $(this).find(".cid-name").find('.user-hidden').val();
		if(src != undefined)
		{
				$(this).find('.user-photo').remove();
		}
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
				if(data == 0)
					var status = "Rejected";
				else if(data == 3)
					var status = "Under Observation";
				else if (data == 4)
				 	var status = "Closed But Not Complete";
				else if(data == 5)
					var status = "Closed";

				$(".select-status").prev('span').text(status);
				$(".select-status").remove();
				$(".change-status").prop("disabled",false);

			if(data == 3)
			{

			}
			else if(data == 4)
			{
			}
			else if(data == 5)
			{

			}
		}
	});
});
$(".complaint-table").on("click",".change-status",function()
{
	var val = $(this).text().trim();
		switch(val)
		{
			case 'Open':
				var html = "<select name='select-status' id='select-status' class='form-control select-status'>\
											<option value='1' selected>Open</option>\
											<option value='0' >Reject</option>\
										</select>";
				$(this).text("");
				$(".change-status").prop("disabled",true);
				$(this).after(html);
			break;
			case 'Pending':
				var html = "<select name='select-status' id='select-status' class='form-control select-status'>\
											<option value='2' selected>Pending</option>\
											<option value='3' >Under Observation</option>\
											<option value='4'>Closed But Not Complete</option>\
											<option value='5'>Closed</option>\
										</select>";
				$(this).text("");
				$(".change-status").prop("disabled",true);
				$(this).after(html);
			break;
			case 'Under Observation':
				var html = "<select name='select-status' id='select-status' class='form-control select-status'>\
											<option value='3' selected>Under Observation</option>\
											<option value='4'>Closed But Not Complete</option>\
											<option value='5'>Closed</option>\
										</select>";
				$(this).text("");
				$(".change-status").prop("disabled",true);
				$(this).after(html);
			break;
			case 'Closed But Not Complete':
			break;
			case 'Closed':
			break;
		}

});
$(".assign-worker").hide();
$(".complaint-table").on("click",".worker",function()
{
	var cid = $(this).find('.cidhidden').val();
	var wcate = $(this).find('.wcate').val();
	var val = $(this).text();
	if(val.localeCompare("Click To Assign") == 0)
	{
		$(this).parent().parent().clone().appendTo(".complaint-table-worker");

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
