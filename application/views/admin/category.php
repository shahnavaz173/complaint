<?php
	if(!$islogin)
		redirect(base_url('login'));
?>
<div class="container-home category-main">

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
<?php
include('addcategory.php');
 ?>
<script type="text/javascript">
$(document).ready(function()
{
	$(".add-category").hide();
	$(".click-to-add").click(function()
	{
		$(".add-category").slideDown("slow");
		$(".category-main").hide();
	});
	$("#datatable").dataTable({
		"ordering": false
	});
	$(window).load(function()
	{
		displayComplaints('all');
	});
	$(".category").change(function()
	{
		displayComplaints($(this).val());
	});
	$("#datatable").on("click",".delete-cate",function()
	{
		var parent = $(this).parent().parent();
		var conf = confirm("Are you sure You want to Delete?");
		if(conf)
		{
			var cid = $(this).next('.c-id').val();
			var datastring = 'cid='+cid;
			$.ajax
			({
				type: "POST",
				url: "<?=base_url("Complaint/delete_common_complaint"); ?>",
				data: datastring,
				cache: false,
				success: function(data)
				{
					parent.remove();
				}
			});
		}
	});
	$("#datatable").on("click",".update-cate",function()
	{
		$(".update-cate").prop('disabled','true');
		$(".update-cate").css('cursor','not-allowed');
		$(this).hide();
		var row = parseInt($(this).next(".row-no").val());
		var cele = $(this).parent("td").parent("tr").find(".wcate");
		var catext = cele.text();
		cele.text("");
		$(".complaintype").clone().appendTo(cele);
		cele.find("select option").each(function()
		{
			if($(this).text() == catext.trim())
			{
				$(this).attr("selected","selected");
			}
		});
		var description = document.getElementById("datatable").rows[row+1].cells[1].innerHTML;
		document.getElementById("datatable").rows[row+1].cells[1].innerHTML = "<textarea rows='3' cols='40' id='description' class='form-control'>"+description+"</textarea>";
		var level = document.getElementById("datatable").rows[row+1].cells[2].innerHTML;
			if(level != 'For Campus Only')
			{
				var html = "<select id='level' class='form-control'>\
										<option value='1' selected>For All</option>\
										<option value='2'>For Campus Only</option>\
										</select>";
			}
			else
			{
				var html = "<select id='level' class='form-control'>\
										<option value='1'>For All</option>\
										<option value='2' selected>For Campus Only</option>\
										</select>";
			}
			document.getElementById("datatable").rows[row+1].cells[2].innerHTML = html;
			$(this).after("<button style='background:none;border:none' title='Save Update' class='glyphicon glyphicon-floppy-save text-success save-update'></button>");
			$(this).parent("td").append("<button style='background:none; border:none' title='Cancel Update' class='glyphicon glyphicon-remove text-danger cancel-update'></button>");
	});
	$("#datatable").on("click",".save-update",function()
	{
		var cate = $(this).parent("td").parent("tr").find(".wcate").find("select").val();
		var coid = $(this).parent("td").parent("tr").find("#coid").val();
		var desc = $("#description").val();
		var level = $("#level").val();
		var obj = {co_id: coid,category: cate,desc: desc, level: level};
		var dataString = 'obj='+JSON.stringify(obj);
		$.ajax
		({
			type: "POST",
			url: "<?=base_url('Complaint/update_common'); ?>",
			data: dataString,
			cache: false,
			success: function(data)
			{

			}
		});

		$(".cancel-update").remove();
		$(".save-update").parent("td").find(".update-cate").show();
		var cate = $(".save-update").parent("td").parent("tr").find(".wcate");
		var desc = $("#description");
		var level = $("#level");
		var lvl = level.val() == 1?'For All':'For Campus Only'
		cate.html(cate.find("select option:selected").text());
		desc.parent("td").html(desc.val());
		level.parent("td").html(lvl);
		$(".update-cate").prop('disabled',false);
		$(".update-cate").css('cursor','pointer');
		$(".save-update").remove();
	});

	$("#datatable").on("click",".cancel-update",function()
	{
			$(".save-update").remove();
			$(this).parent("td").find(".update-cate").show();
			var cate = $(this).parent("td").parent("tr").find(".wcate");
			var desc = $("#description");
			var level = $("#level");
			var lvl = level.val() == 1?'For All':'For Campus Only'
			cate.html(cate.find("select option:selected").text());
			desc.parent("td").html(desc.val());
			level.parent("td").html(lvl);
			$(".update-cate").prop('disabled',false);
			$(".update-cate").css('cursor','pointer');
			$(this).remove();
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
						"<span class='wcate'>"+dataArr[i].category+"</span><input type='hidden' id='coid'value='"+dataArr[i].co_id+"' />",
						dataArr[i].description,
						level,
						"<button style='background:none;border:none' title='Update' class='glyphicon glyphicon-pencil text-info update-cate'></button><input type='hidden' class='row-no' value='"+i+"' >",
						"<button style='background:none;border:none' title='Delete' class='glyphicon glyphicon-trash text-danger delete-cate'></button><input type='hidden' class='c-id' value='"+dataArr[i].co_id+"' />"
					]);
					var ntr = table.fnSettings().aoData[ added[0] ].nTr;
					ntr.className = chclass;

			}

		}
	});
}
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
