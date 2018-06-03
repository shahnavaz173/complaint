<div class="row" id="print">
  <div class="col-md-4 col-md-offset-3"  style="border:1px solid #000">
    <h4>GujaratVidyapith Astate Department</h4>
    <hr />
    <div class="col-md-6">
      <h5><b>Complaint Id</b></h5>
      <p><?=$printc['c_id'];?></p>
    </div>
    <div class="col-md-6">
      <h5><b>Complaint Date</b></h5>
      <p><?=$printcomplaint[0]->c_date;?></p>
    </div>
    <div class="col-md-6">
      <h5><b>User Name</b></h5>
      <p><?=$printcomplaint[0]->full_name;?></p>
    </div>
    <div class="col-md-6">
      <h5><b>Phone No</b></h5>
      <p><?=$printcomplaint[0]->pho_no;?></p>
    </div>
    <div class="col-md-6">
      <h5><b>Complainnt Description</b></h5>
      <p><?=$printcomplaint[0]->c_description;?></p>
    </div>
    <div class="col-md-6">
      <h5><b>Complainnt location</b></h5>
      <p><?=$printcomplaint[0]->c_description;?></p>
    </div>
    <div class="col-md-6">
      <h5><b>Worker Name</b></h5>
      <p><?=$printcomplaint[0]->w_name;?></p>
    </div>
    <div class="col-md-6">
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
