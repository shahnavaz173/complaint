
<div class="container-home worker-main">
	<div class="row">
		<div class="col-md-12">
      <div class="form-inline">
				<div class="form-group col-md-2 ">
          <label for='duration'>Duration:</label>
					    <select name='duration' id='duration' class='form-control'>
                <option value='1'>Monthly</option>
                <option value='3'>Quartarly</option>
                <option value='6'>6 Monthly</option>
                <option value='12'>Yearly</option>
                <option value='2'>Between</option>
              </select>
				</div>
        <div class="form-group col-md-4 ">
          <label for='by'> ReportsBy:</label>
					    <select name='by' id='by' class='form-control'>
                <option value="1">Complaints</option>
                <option value="2">Workers</option>
              </select>
							<label for='category'>Category:</label>
							    <select name='category' id='category' class='form-control'>
		                <?php foreach($categories as $category): ?>
		                  <option value="<?=$category->cate_id; ?>"><?=$category->category; ?></option>
		                <?php endforeach; ?>
		              </select>
				</div>
        <div class="form-group col-md-3 ">

            <label for='worker'>Worker:</label>
  					    <select name='worker' id='worker' class='form-control'>
                    <option value="">Worker</option>
                </select>
				</div>
        <div class="form-group col-md-3 ">
          <button id="display" class="btn btn-warning">Display Reports</button>
          <button id="generate" class="btn btn-warning">Generate PDF</button>
				</div>
      </div>

      <div class="form-inline" style="padding-top:50px">
        <div class="form-group col-md-8 between">
          <label for="begin">From date: </label>
          <input type='date' name='begin' id='begin' class='form-control' placeholder="From date" />
          <label for="to">To date: </label>
          <input type='date' name='end' id='end' class='form-control'  placeholder="To date" />
				</div>
			</div>
    </div>
	</div>
  <div class="row" >
		<div class="col-md-12">
			<div class="table-responsive">
        <table class="table table-striped table-bordered tbl-by-worker"  >
					<caption><center><b>Reports of Worker</b></center></caption>
						<thead>
							<tr class="list-head ">
	                <th>Complaint</th>
	                <th style="width:10em;">Pending Complaints</th>
	                <th style="width:10em;">Under Observation Complaints</th>
	                <th style="width:10em;">Closed But Not Complete</th>
	                <th style="width:10em;">Closed Complaints</th>
	                <th style="width:10em;">Rejected Complaints</th>
							</tr>
					</thead>
					<tbody id="tbody-worker">
					</tbody>
				</table>
        <table class="table table-striped table-bordered tbl-by-complaint"  >
					<caption><center><b>Reports of Complaints</b></center></caption>
					<thead>
							<tr class="list-head ">
	                <th >Complaint</th>
									<th style="width:10em;">Open Complaints</th>
	                <th style="width:10em;">Pending Complaints</th>
	                <th style="width:10em;">Under Observation Complaints</th>
	                <th style="width:10em;">Closed But Not Complete</th>
	                <th style="width:10em;">Closed Complaints</th>
	                <th style="width:10em;">Rejected Complaints</th>
							</tr>
					</thead>
					<tbody id="tbody-complaint">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function()
{
  $("table").hide();
  $(".between").hide();
  $("#worker").prop('disabled',true);
  $("#by").change(function()
  {
    var by = $(this).val();
		if(by == 1)
    {
      $("#worker").prop('disabled',true);

    }
    else
    {
      $("#worker").prop('disabled',false);

    }
  });

  $("#display").click(function()
  {
    var by = $("#by").val();
		var duration = $("#duration").val();
		var category = $("#category").val();
		var worker = $("#worker").val();

    if(by == 1)
    {
      $(".tbl-by-worker").hide();
      $(".tbl-by-complaint").show();
			var obj = {duration:duration, by: by, category: category};
			obj = JSON.stringify(obj)
			var formData = 'data='+obj;
			$.ajax
			({
				type: "POST",
				url: "<?=base_url('Reports/get_complaint_report'); ?>",
				data: formData,
				cache: false,
				success: function(data)
				{
					$(".lists").remove();
					var dataArr = JSON.parse(data);
					for(var i=0;i<dataArr.length;i++)
					{
							var html = "\
							<tr class='lists'>\
								<td>"+dataArr[i].c_description+"</td>\
								<td style='text-align:center'>"+dataArr[i].open+"</td>\
								<td style='text-align:center'>"+dataArr[i].pending+"</td>\
								<td style='text-align:center'>"+dataArr[i].uobserv+"</td>\
								<td style='text-align:center'>"+dataArr[i].closed_not+"</td>\
								<td style='text-align:center'>"+dataArr[i].closed+"</td>\
								<td style='text-align:center'>"+dataArr[i].rejected+"</td>\
							</tr>";
							$("#tbody-complaint").append(html);
					}
				}
			});
    }
    else
    {
      $(".tbl-by-complaint").hide();
      $(".tbl-by-worker").show();
			var obj = {duration:duration, by: by, category: category,worker:worker};
			obj = JSON.stringify(obj)
			var formData = 'data='+obj;
			$.ajax
			({
				type: "POST",
				url: "<?=base_url('Reports/get_worker_report'); ?>",
				data: formData,
				cache: false,
				success: function(data)
				{
					$(".lists").remove();
					var dataArr = JSON.parse(data);
					for(var i=0;i<dataArr.length;i++)
					{
							var html = "\
							<tr class='lists'>\
								<td>"+dataArr[i].c_description+"</td>\
								<td style='text-align:center'>"+dataArr[i].pending+"</td>\
								<td style='text-align:center'>"+dataArr[i].uobserv+"</td>\
								<td style='text-align:center'>"+dataArr[i].closed_not+"</td>\
								<td style='text-align:center'>"+dataArr[i].closed+"</td>\
								<td style='text-align:center'>"+dataArr[i].rejected+"</td>\
							</tr>";
							$("#tbody-worker").append(html);
					}
				}
			});
    }


  });
  $("#category").change(function()
  {
    var  cate_id = $(this).val();
		getWorkers(cate_id);
  });
	$(window).load(function()
	{
		getWorkers(1);
	});
  $("#duration").change(function()
  {
    var duration = $("#duration").val();
    if(duration == 2)
    {
      $(".between").show();
    }
    else
    {
      $(".between").hide();
    }
  });

	function getWorkers(cate_id)
	{
		var dataString = 'cate='+cate_id;

		$.ajax
		({
			type: "POST",
			url: "<?=base_url('Worker/get_worker_list'); ?>",
			data: dataString,
			cache: false,
			success: function(data)
			{
				var dataArr = JSON.parse(data);
				$("#worker").html("");
				for(var i=0;i<dataArr.length;i++)
				{
					$("#worker").append("<option value='"+dataArr[0].w_id+"'>"+dataArr[0].w_name+"</option>");
				}
			}
		});
	}
});
</script>
