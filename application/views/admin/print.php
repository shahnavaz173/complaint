
<div class="row" id="print">
  <div class=""  style="width: 380px;height:380px;margin-left:2em;padding:.5em;border:1px solid #000">
    <h4>GujaratVidyapith Estate Department</h4>
    <hr />
    <div style="width:50%; float: left;">
      <h5><b>Complaint Id</b></h5>
      <p><?=$printc['c_id'];?></p>
    </div>
    <div style="width:50%;float: left;">
      <h5><b>Complaint Date</b></h5>
      <p><?=$printcomplaint[0]->c_date;?></p>
    </div>
    <div style="width:50%;float: left;">
      <h5><b>User Name</b></h5>
      <p><?=$printcomplaint[0]->full_name;?></p>
    </div>
    <div style="width:50%;float: left;">
      <h5><b>Phone No</b></h5>
      <p><?=$printcomplaint[0]->pho_no;?></p>
    </div>
    <div style="width:50%;float: left;">
      <h5><b>Complainnt Description</b></h5>
      <p><?=$printcomplaint[0]->c_description;?></p>
    </div>
    <div style="width:50%;float: left;">
      <h5><b>Complainnt location</b></h5>
      <p><?=$printcomplaint[0]->c_description;?></p>
    </div>
    <div style="width:50%;float: left;">
      <h5><b>Worker Name</b></h5>
      <p><?=$printcomplaint[0]->w_name;?></p>
    </div>
    <div style="width:50%;float: left;">
      <h5><b>Worker Sign</b></h5>
      <p style="border-bottom:1px solid #222;">&nbsp;</p>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function()
{
  $(window).load(function()
  {
    var printable_content = document.getElementById('print').innerHTML;
    document.body.innerHTML = printable_content;
    if(window.print())
      window.location = "<?=base_url('admin'); ?>";
    else
      window.location = "<?=base_url('admin'); ?>";

  });
});
</script>
