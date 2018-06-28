<?php
	if(!$islogin)
		redirect(base_url('login'));
?>
<script type="text/javascript" src="<?=base_url('assets/js/chart.js'); ?>"></script>
<div class="container-home">
  <div class="row" >
		<div class="col-md-9">
			<div class="table-responsive">
				<table class="table  table-bordered complaint-table"  id ="datatable" >
					<caption><center><h4>Complaint List</h4></center></caption>
					<thead>
						<tr class="list-head ">
							<th>Date</th>
							<th class="ctype-row">Type</th>
							<th>Description</th>
							<th>Complaint Location</th>
							<th>Status</th>
							<th class="assign-th">Worker</th>
						</tr>
					<thead>
					<tbody>
            <?php foreach ($ucomplaints as $c): ?>
              <tr>
								<?php
								switch($c->c_status)
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
								}
								?>
                <td><?=$c->c_date;?></td>
                <td><?=$c->category;?></td>
                <td><?=$c->c_description;?></td>
                <td><?=$c->location;?></td>
                <td><?=$status;?></td>
                <td><?php
                if($c->w_name == NULL)
                  echo "Not Assigned";
                else
                  echo $c->w_name;
                ?></td>
              </tr>
            <?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-3 " id="chart" style="padding:0.2em; margin-top:6.6em;">

		</div>
	</div>
</div>

<script type="text/javascript">
google.charts.load('current',{'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart()
{
	var data = google.visualization.arrayToDataTable([
		['Complaint Status', 'No of Complaints'],
		['Rejected', <?=$chartdata['Rejected']; ?>],
		['Open', <?=$chartdata['Open']; ?>],
		['Pending', <?=$chartdata['Pending']; ?>],
		['Under Observation', <?=$chartdata['UnderObservation']; ?>],
		['Closed But Not Complete',<?=$chartdata['ClosedButNotComplete']; ?>],
		['Closed',<?=$chartdata['Closed']; ?>]
	]);
	var options = {"title":"Complaint Analysis","width":300,"height":260};
	var chart = new google.visualization.PieChart(document.getElementById('chart'));
	chart.draw(data,options);
}
$(document).ready(function()
{
  var table = $("#datatable").dataTable({
		"ordering":false
	});
	$("input[type='search']").on("change",function()
	{

	});
  table.find("tr:odd").addClass('bg-info');
  table.find("tr:odd").addClass('text-info');
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
