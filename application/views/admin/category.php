<?php
	if(!$islogin)
		redirect(base_url('login'));
?>
<div class="container-home worker-main">
  <div class="jumbotron jumbotron-main">
		<h1>Common Complaints</h1>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="form-row">
				<div class="form-group col-md-3 ">
					<button class="btn btn-warning click-to-add" ><span class="glyphicon glyphicon-plus"></span> Click To Add New </button>
				</div>
				<?=form_open('',array()); ?>
				<div class="form-group col-md-5 col-md-offset-1">
					<label for="category">Category: </label>
					<select name="category" class="form-control category">
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
	</div>
	<div class="row" >
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
			<div class="table-responsive">
				<table class="table  table-bordered category-table" id="table" >
					<tr class="list-head ">
            <th>Category</th>
            <th>Complaint Description</th>
            <th>For Whom</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function()
{
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
					var html = "<tr class='"+chclass+"'>\
					<td>"+dataArr[i].category+"</td>\
					<td>"+dataArr[i].description+"</td>\
					<td>"+level+"</td>\
					</tr>";
					$(".category-table").append(html);
				}
			}

		}
	});
}
</script>
