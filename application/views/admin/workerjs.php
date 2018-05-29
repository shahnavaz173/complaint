

<script type="text/javascript">

$(document).ready(function()
{
	$(".add-new-worker").hide();
	$(".click-to-add").click(function()
	{
		$(".add-new-worker").slideDown("slow");
		$(".worker-main").hide();
	});
	$(".cancel-add-worker").click(function()
	{
			$(".add-new-worker").hide();
			$(".worker-main").slideDown();
	});
	$(".worker-type").change(function()
	{
		display_workers($(this).val());
	});
	$(window).load(function()
	{
		display_workers('all');
	});
	$(".worker-table").on("click",".update-worker",function()
	{
		$(".update-worker").prop('disabled','true');
		$(".update-worker").css('cursor','not-allowed');
		$(this).hide();
		var row = parseInt($(this).next(".row-no").val());
		var name = document.getElementById("datatable").rows[row+1].cells[0].innerHTML;
		document.getElementById("datatable").rows[row+1].cells[0].innerHTML = "<input type='text' id='wname' class='form-control' value='"+name+"'>";
		var phno = document.getElementById("datatable").rows[row+1].cells[1].innerHTML;
		document.getElementById("datatable").rows[row+1].cells[1].innerHTML = "<input type='text' id='phno' class='form-control' value='"+phno+"'>";
		var email = document.getElementById("datatable").rows[row+1].cells[2].innerHTML;
		document.getElementById("datatable").rows[row+1].cells[2].innerHTML = "<input type='text' id='email' class='form-control' value='"+email+"'>";
		var add = document.getElementById("datatable").rows[row+1].cells[3].innerHTML;
		document.getElementById("datatable").rows[row+1].cells[3].innerHTML = "<textarea id='add' rows='3' cols='30' class='form-control'>"+add+"</textarea>";
		var cele = $(this).parent("td").parent("tr").find(".wcate");
		var catext = cele.text();
		cele.text("");
		$(".worker-skill").clone().appendTo(cele);
		cele.find("select option").each(function()
		{
			if($(this).text() == catext.trim())
			{
				$(this).attr("selected","selected");
			}
		});
		$(this).after("<button style='background:none;border:none' title='Save Update' class='glyphicon glyphicon-floppy-save text-success save-update'></button>");
		$(this).parent("td").append("<button style='background:none; border:none' title='Cancel Update' class='glyphicon glyphicon-remove text-danger cancel-update'></button>");

	});

	$(".worker-table").on("click",".save-update",function()
	{
		var name = $("#wname").val();
		var phno = $("#phno").val();
		var email = $("#email").val();
		var add = $("#add").val();
		var skill = $(this).parent("td").parent("tr").find(".wcate").find("select").val();
		var wid = $(this).parent("td").parent("tr").find(".change-status").find(".worker-id").val();
		var worker_data = {w_id:wid,w_name:name,ph_no:phno,email:email,address:add,skill:skill};
		var dataString = 'obj='+JSON.stringify(worker_data);

		$.ajax
		({
			type: "POST",
			url: "<?=base_url('Worker/update_worker'); ?>",
			data: dataString,
			cache: false,
			success: function(response)
			{
				if(response.localeCompare('success') == 0)
				{
					$('.save-update').parent("td").find(".update-worker").show();
					$("#wname").parent("td").text($("#wname").val());
					$("#wname").remove();
					$("#phno").parent("td").text($("#phno").val());
					$("#phno").remove();
					$("#email").parent("td").text($("#email").val());
					$("#email").remove();
					$("#add").parent("td").text($("#add").val());
					$("#add").remove();
					var cate = $(".save-update").parent("td").parent("tr").find(".wcate");
					cate.text(cate.find("select").find("option:selected").text());
					cate.remove("select");
					$(".update-worker").prop('disabled',false);
					$(".update-worker").css('cursor','pointer');

					$(".save-update").remove();
					$(".cancel-update").remove();
				}
			}
		});
	});
	$(".worker-table").on("click",".cancel-update",function()
	{
		$(".save-update").remove();
		$(this).parent("td").find(".update-worker").show();
		$("#wname").parent("td").text($("#wname").val());
		$("#wname").remove();
		$("#phno").parent("td").text($("#phno").val());
		$("#phno").remove();
		$("#email").parent("td").text($("#email").val());
		$("#email").remove();
		$("#add").parent("td").text($("#add").val());
		$("#add").remove();
		var cate = $(this).parent("td").parent("tr").find(".wcate");
		cate.text(cate.find("select").find("option:selected").text());
		cate.remove("select");
		$(".update-worker").prop('disabled',false);
		$(".update-worker").css('cursor','pointer');
		$(this).remove();
	});


	$(".worker-table").on("click",".delete-worker",function()
	{
		var parent = $(this).parent("td").parent("tr");
		var conf = confirm("Are You Sure You Want To Delete?");
		if(conf == true)
		{
			var wid = $(this).parent("td").parent("tr").find(".change-status").find(".worker-id").val();
			var dataString = 'id='+wid;
			$.ajax
			({
				type: "POST",
				url: "<?=base_url('Worker/delete_worker'); ?>",
				data: dataString,
				cache: false,
				success: function(response)
				{
					if(response == 'success')
					{
						parent.remove();
					}
				}
			});
		}

	});
	$(".worker-table").on("click",".change-status",function()
	{
		var conf =confirm("Are you Sure You want to Change the Status?");
		if(conf == true)
		{
				var id = $(this).find(".worker-id").val();
				var ele = $(this);
				var dataString = 'id='+id;
				$.ajax
				({
						type: "POST",
						url: "<?=base_url('Worker/change_status'); ?>",
						data: dataString,
						cache: false,
						success: function(data)
						{
								var html = data+"<input type='hidden' class='worker-id' value='"+id+"' >";
								if(data.localeCompare('Active'))
								{
									ele.parent('td').parent('tr').removeClass('text-info');
									ele.parent('td').parent('tr').addClass('text-danger');
								}
								else
								{
									ele.parent('td').parent('tr').removeClass('text-danger');
									ele.parent('td').parent('tr').addClass('text-info');
								}
								ele.html(html);
						}
				});
		}
	});
});
function display_workers(id)
{
	var datastring = 'cate='+ id;
	if(id != '')
	{
		$.ajax
		({
			type: "POST",
			url: "<?=base_url('Worker/get_worker_list'); ?>",
			data: datastring,
			cache: false,
			success: function(data)
			{
				$(".lists").remove();
				var dataArr = JSON.parse(data);
				if(dataArr.length == 0)
				{
					var html = "\
					<tr class='lists'>\
						<td colspan='8' class='bg-warning text-warning'><h4><center>No Workers Found</center></h4></td>\
					</tr>";
					$(".skill-row").hide();
					$(".worker-table").append(html);
				}
				else
	      {

	        for(i = 0; i<dataArr.length; i++)
	        {
						var table = $("#datatable").dataTable();
						var added =	table.fnAddData([
								dataArr[i].w_name,
								dataArr[i].ph_no,
								dataArr[i].email,
								dataArr[i].address,
								"<span class='wcate'>"+dataArr[i].category+"</span>",
								"<span style='cursor:pointer' class='change-status'>"+dataArr[i].w_status+"<input type='hidden' class='worker-id' value='"+dataArr[i].w_id+"' ></span>",
								"<button style='background:none;border:none' title='Update' class='glyphicon glyphicon-pencil text-info update-worker'></button><input type='hidden' class='row-no' value='"+i+"' >",
								"<button style='background:none;border:none' title='Delete' class='glyphicon glyphicon-trash text-danger delete-worker'></button>"
							]);
						var ntr = table.fnSettings().aoData[ added[0] ].nTr;
						if(dataArr[i].w_status.localeCompare('Active') == 0)
							var chclass = 'text-info';
						else
							var chclass = 'text-danger';
						ntr.className = chclass;
	        }
				}
			}
		});
	}
}
</script>
