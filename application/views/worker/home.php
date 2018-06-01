<?php
	if(!$islogin)
		redirect(base_url('login'));
?>


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
						</tr>
					<thead>
					<tbody>
						<?php foreach($clist as $datalist):?>
							<?php
							switch($datalist->c_status)
							{
								case 1:
									$status = "Open";
									$chkclass = 'bg-danger text-danger';
								break;
								case 2:
									$status = "Pending";
									$chkclass = 'bg-danger text-danger';
								break;
								case 3:
									$status = "Under Observation";
									$chkclass = 'bg-warning text-warning';
								break;
								case 4:
									$status = "Closed But Not Complete";
									$chkclass = 'bg-warning text-warning';
								break;
								case 5:
									$status = "Closed";
									$chkclass = 'bg-success text-success';
								break;
							}
							?>
						<tr class="<?=$chkclass; ?>">

							<td><?php echo $datalist->c_date; ?></td>
							<td><span class='uname'><?=$datalist->full_name; ?></span><span class='cid-name'><br><?=$datalist->ph_no; ?></span></td>
							<td><?=$datalist->Dept_Name; ?></td>
							<td><?=$datalist->category; ?></td>
							<td><?=$datalist->c_description; ?></td>
							<td><?=$datalist->location; ?></td>
							<td><span style='cursor:pointer;' class='change-status'><?=$status; ?></span><input type='hidden' class='cidhidden' value='<?=$datalist->c_id; ?>'></td>
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
				if(data == 3)
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

</script>
