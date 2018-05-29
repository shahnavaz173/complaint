<?php
	if(!$islogin)
		redirect(base_url('login'));
?>
<div class="container-home worker-main">

	<div class="row">
		<div class="col-md-12 ">
			<div class="form-row">
				<div class="form-group col-md-2 col-md-offset-10 ">
					<button class="btn btn-warning click-to-add" ><span class="glyphicon glyphicon-plus"></span> Click To Add New </button>
				</div>
				<?=form_open('',array()); ?>

			</div>
			<?=form_close(); ?>
		</div>
	</div>
	<div class="row" >
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table  table-bordered category-table" id="datatable" >
					<caption><center><h5><b>Common Complaints</b></h5></center></caption>
					<thead>
						<tr class="list-head ">
	            <th>Category</th>
	            <th>Complaint Description</th>
	            <th>For Whom</th>
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
$(document).ready(function()
{
	$("#datatable").dataTable();
	$(window).load(function()
	{
		displayComplaints('all');
	});
	$(".category").change(function()
	{
		displayComplaints($(this).val());
	});
});
function displayComplaints(id)
{
	$(".lists").remove();
	var datastring = 'id='+id;
	$.ajax
	({
		type: "POST",
		url: "<?=base_url('Complaint/get_description'); ?>",
		data: datastring,
		cache: false,
		success: function(data)
		{
			var dataArr =JSON.parse(data);
			if(dataArr.length == 0)
			{
				$(".category-table").append("<tr class='lists bg-warning text-warning'><td colspan='3'><center><h3>No Complaints Found</h3></center></td></tr>");
			}
			else
			{
				for(var i=0;i<dataArr.length;i++)
				{
					if(i%2 == 0)
						var chclass = "lists text-info bg-info";
					else
						var chclass = "lists";
					if(dataArr[i].c_level ==2)
						var level = "For Campus Only";
					else
						var level = "For All";

					var table = $("#datatable").dataTable();
					var added = table.fnAddData([
						dataArr[i].category,
						dataArr[i].description,
						level,
						"<button style='background:none;border:none' title='Update' class='glyphicon glyphicon-pencil text-info update-worker'></button><input type='hidden' class='row-no' value='"+i+"' >",
						"<button style='background:none;border:none' title='Delete' class='glyphicon glyphicon-trash text-danger delete-worker'></button>"
					]);
					var ntr = table.fnSettings().aoData[ added[0] ].nTr;
					ntr.className = chclass;
				}
			}

		}
	});
}
</script>
