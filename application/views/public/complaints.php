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
                <td><?=$c->c_date;?></td>
                <td><?=$c->category;?></td>
                <td><?=$c->c_description;?></td>
                <td><?=$c->location;?></td>
                <td><?=$c->c_status;?></td>
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
	</div>
</div>
<script type="text/javascript">
$(document).ready(function()
{
  var table = $("#datatable").dataTable({
		"ordering":false
	});
  table.find("tr:odd").addClass('bg-info');
  table.find("tr:odd").addClass('text-info');
});
</script>
