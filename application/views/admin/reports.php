
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
        <div class="form-group col-md-3 ">
          <label for='by'> ReportsBy:</label>
					    <select name='by' id='by' class='form-control'>
                <option value="1">Complaints</option>
                <option value="2">Workers</option>
              </select>
				</div>
        <div class="form-group col-md-4 ">
          <label for='category'>Category:</label>
					    <select name='category' id='category' class='form-control'>
                <?php foreach($categories as $category): ?>
                  <option value="<?=$category->cate_id; ?>"><?=$category->category; ?></option>
                <?php endforeach; ?>
              </select>
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
        <div class="form-group col-md-4 between">
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
						<tr class="list-head ">
                <th>Name</th>
                <th style="width:14em;">Complaint</th>
                <th style="width:14em;">Pending Complaints</th>
                <th style="width:14em;">Under Observation Complaints</th>
                <th style="width:14em;">Closed But Not Complete</th>
                <th style="width:14em;">Closed Complaints</th>
						</tr>
				</table>
        <table class="table table-striped table-bordered tbl-by-complaint"  >
					<caption><center><b>Reports of Complaints</b></center></caption>
						<tr class="list-head ">
                <th style="width:14em;">Complaint</th>
                <th style="width:14em;">Pending Complaints</th>
                <th style="width:14em;">Under Observation Complaints</th>
                <th style="width:14em;">Closed But Not Complete</th>
                <th style="width:14em;">Closed Complaints</th>
						</tr>
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
    if(by == 1)
    {
      $(".tbl-by-worker").hide();
      $(".tbl-by-complaint").show();
    }
    else
    {
      $(".tbl-by-complaint").hide();
      $(".tbl-by-worker").show();
    }

  });
  $("#category").change(function()
  {

    var  cate_id = $(this).val();

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
});
</script>
