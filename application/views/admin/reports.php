<div class="container-home worker-main">
	<div class="row">
		<div class="col-md-12">
      <div class="form-inline">
				<div class="form-group col-md-2 ">
          <label for='duration'>Duration:</label>
					    <select name='duration' id='duration' class='form-control'>
                <option value='1' selected>Monthly</option>
                <option value='3'>Quartarly</option>
                <option value='6'>6 Monthly</option>
                <option value='12'>Yearly</option>
                <option value='2'>Between</option>
              </select>
				</div>
        <div class="form-group col-md-4 ">
          <label for='by'> ReportsBy:</label>
					    <select name='by' id='by' class='form-control'>
                <option value="1" selected>Complaints</option>
                <option value="2">Workers</option>
              </select>
							<label for='category'>Category:</label>
							    <select name='category' id='category' class='form-control'>
										<option value='0' selected>all</option>
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
          <button id="generate" class="btn btn-warning" onclick="generate()">Generate PDF</button>
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
<div id="editor"></div>
  <div class="row" >
		<div class="col-md-12">
			<div class="table-responsive" id="content">
        <table class="table table-striped table-bordered tbl-by-worker" id="datatable-2"  >
					<caption><center><b>Reports of Worker</b></center></caption>
						<thead>
							<tr class="list-head ">
	                <th>Complaint</th>
	                <th style="width:8em;">Pending</th>
	                <th style="width:8em;">Under Observation</th>
	                <th style="width:8em;">Closed But Not Complete</th>
	                <th style="width:8em;">Closed</th>
									<th style="width:8em;">Rejected</th>
	                <th style="width:8em;">Total</th>
							</tr>
					</thead>
					<tbody id="tbody-worker">
					</tbody>
				</table>
        <table class="table table-striped table-bordered tbl-by-complaint" id="datatable-1" >
					<caption><h4><center><b>Reports of Complaints</b></center></h4></caption>
					<thead>
							<tr class="list-head ">
	                <th >Complaint</th>
									<th style="width:8em;">Open</th>
	                <th style="width:8em;">Pending</th>
	                <th style="width:8em;">Under Observation</th>
	                <th style="width:8em;">Closed But Not Complete</th>
	                <th style="width:8em;">Closed</th>
									<th style="width:8em;">Rejected</th>
	                <th style="width:8em;">Total</th>
							</tr>
					</thead>
					<tbody id="tbody-complaint">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src='<?=base_url('assets/js/jspdf.min.js'); ?>'></script>
<script src='<?=base_url('assets/js/jspdf.plugin.autotable.js'); ?>'></script>

<script type="text/javascript">
var fileName = null;
var reportHeading = null;
var tableSource = null;
var d = new Date()
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
		var workername = $("#worker option:selected").text();
		var categoryname = $("#category option:selected").text();
		if(duration == 2)
		{
			var begin = $("#begin").val();;
			var end = $("#end").val();;
		}
    if(by == 1)
    {

				switch(duration)
				{
					case '1':
							var caption = "Monthly Report of "+ categoryname+" Complaints";
					break;
					case '3':
							var caption = "Quartarly Report of "+ categoryname+" Complaints";
					break;
					case '6':
							var caption = "6 Monthly Report of "+ categoryname+" Complaints";
					break;
					case '12':
							var caption = "Yearly Report of "+ categoryname+" Complaints";
					break;
					default:
						var caption = "Report of "+ categoryname+" Complaints Between "+begin+" to "+end;
					}
					reportHeading = caption;
					tableSource = "datatable-1";
					fileName = "report-"+categoryname+d.getDate()+"-"+d.getMonth()+".pdf";
				$(".tbl-by-complaint caption").html("<h4><center><b>"+caption+"</b></center></h4>")
      $(".tbl-by-worker").hide();
      $(".tbl-by-complaint").show();
			if(duration == 2)
				var obj = {duration:duration, by: by, category: category,begin: begin, end: end};
			else
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
						var total = parseInt(dataArr[i].open)+parseInt(dataArr[i].pending)+parseInt(dataArr[i].uobserv)+parseInt(dataArr[i].closed_not)+parseInt(dataArr[i].closed)+parseInt(dataArr[i].rejected);
							var html = "\
							<tr class='lists'>\
								<td>"+dataArr[i].c_description+"</td>\
								<td style='text-align:center'>"+dataArr[i].open+"</td>\
								<td style='text-align:center'>"+dataArr[i].pending+"</td>\
								<td style='text-align:center'>"+dataArr[i].uobserv+"</td>\
								<td style='text-align:center'>"+dataArr[i].closed_not+"</td>\
								<td style='text-align:center'>"+dataArr[i].closed+"</td>\
								<td style='text-align:center'>"+dataArr[i].rejected+"</td>\
								<td style='text-align:center'>"+total+"</td>\
							</tr>";
							$("#tbody-complaint").append(html);
					}
				}
			});
    }
    else
    {
			switch(duration)
			{
				case '1':
						var caption = "Monthly Report of: "+ workername;
				break;
				case '3':
						var caption = "Quartarly Report of: "+ workername;
				break;
				case '6':
						var caption = "6 Monthly Report of: "+ workername;
				break;
				case '12':
						var caption = "Yearly Report of: "+ workername;
				break;
				default:
					var caption = "Report of: "+ workername+" Between "+begin+" to "+end;
				}

			reportHeading = caption;
			tableSource = "datatable-2";
			fileName = "report-"+workername+d.getDate()+"-"+d.getMonth()+".pdf";
			$(".tbl-by-worker caption").html("<h4><center><b>"+caption+"</b></center></h4>")
      $(".tbl-by-complaint").hide();
      $(".tbl-by-worker").show();
			if(duration == 2)
				var obj = {duration:duration, by: by, category: category, worker:worker, begin: begin, end: end};
			else
				var obj = {duration:duration, by: by, category: category, worker:worker};
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
						var total = parseInt(dataArr[i].pending)+parseInt(dataArr[i].closed)+parseInt(dataArr[i].uobserv)+parseInt(dataArr[i].closed_not)+parseInt(dataArr[i].rejected);
							var html = "\
							<tr class='lists'>\
								<td>"+dataArr[i].c_description+"</td>\
								<td style='text-align:center'>"+dataArr[i].pending+"</td>\
								<td style='text-align:center'>"+dataArr[i].uobserv+"</td>\
								<td style='text-align:center'>"+dataArr[i].closed_not+"</td>\
								<td style='text-align:center'>"+dataArr[i].closed+"</td>\
								<td style='text-align:center'>"+dataArr[i].rejected+"</td>\
								<td style='text-align:center'>"+total+"</td>\
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
		getWorkers(0);
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
					$("#worker").append("<option value='"+dataArr[i].w_id+"'>"+dataArr[i].w_name+"</option>");
				}
			}
		});
	}

});

function generate() {
	var doc = new jsPDF('p', 'pt','a4');

   var res = doc.autoTableHtmlToJson(document.getElementById(tableSource));
   //doc.autoTable(res.columns, res.data, {margin: {top: 80}});

 var cols = ["Complaint Description", "Open", "Pending", "Under\nObservation","Closed But\nNot Complete", "Closed", "Rejected", "Total"];
 	//doc.autoTable(res.columns, res.data, options);

	var pageContent = function (data) {
	        // HEADER
	        doc.setFontSize(10);
	        doc.setTextColor(40);
	        doc.setFontStyle('normal');
					doc.text(reportHeading,  15, 22);

	        // FOOTER
	        var str = "Page " + data.pageCount;
	        // Total page number plugin only available in jspdf v1.0+
	        if (typeof doc.putTotalPages === 'function') {
	            str = str + " of " + doc.internal.getNumberOfPages();
	        }
	        doc.setFontSize(10);
	        var pageHeight = doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
	        doc.text(str, data.settings.margin.left, pageHeight  - 10);
	    };
		if($("#by").val() == 2)
			cols.shift();
		doc.autoTable(cols, res.data, {
	 			margin: {horizontal: 7},
	 			styles: {columnWidth: 'wrap'},
	 			columnStyles: {0:{columnWidth: 230},text: {columnWidth: 'auto'}},
				addPageContent: pageContent
 		});


   doc.save(fileName);
}


 </script>
