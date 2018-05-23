<?php

$this->load->helper('url');
$type = $this->uri->segment(2);
echo $type;
//$type="civil";


?>
<script>
$(document).ready(function(){
$(‘.datepicker’).datepicker();
});
</script>
<script type="text/javascript" src="<?=base_url();?>assets/js/validation.js"></script>
<div class="row">
	<div class="col-md-6 col-md-offset-3 container-reg">
		<div class="row">
			<div class="jumbotron jumbotron-main">
				<h1>Add Your Complaint</h1>
			</div>
		</div>
		<?=form_open(base_url('validation/register'),array('class' => 'form-register','method'=>'POST')); ?>
		<div class='row'>
			<div class="form-group  col-md-10 col-md-offset-1 ">
				<label for="fullname">Select complaint Type: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-list"></span></span>
						<?=form_dropdown('ctype',array('carpenter' => 'Carpenter', 'civil' => 'Civil','electrical'=>'Electrical','plumbering'=>'Plumbering','drainage'=>'Drainage'),$type,array('class' => 'form-control', 'id' => 'ctype')); ?>
				</div>
			</div>
		</div>

    <div class='row'>
      <div class="form-group col-md-10 col-md-offset-1">
        <label for="complaintdescription">Complaint Description: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-list"></span></span>
						<?=form_dropdown('cdescription',array('carpenter' => 'Carpenter', 'civil' => 'Civil','electrical'=>'Electrical','plumbering'=>'Plumbering','drainage'=>'Drainage'),'electrical',array('class' => 'form-control', 'id' => 'cdescription')); ?>
				</div>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-10 col-md-offset-1">
        <label for="complaintype">Complaint Category: </label>
        <select name="complaintype" class="form-control complaintype">
          <option value="">Select Category</option>
          <option value="all">All</option>
          <?php foreach ($complaint_desc as $description): ?>
            <option value="<?php echo $description->c_id; ?>"><?php echo $description->c_description; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class='row'>
			<div class="form-group  col-md-10 col-md-offset-1 ">
        <label for="date">Date: </label>
				<div class="input-group">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
						<?=form_input(array('class' => 'datepicker form-control', 'id' => 'date','name'=>'date','type'=>'date')); ?>
				</div>
			</div>
		</div>

    <div class='row'>
			<div class="form-group  col-md-10 col-md-offset-1">
        <label for="location">Location: </label>
        <div class="input-group">
          <span class="input-group-addon"> <span class="glyphicon glyphicon-home"></span></span>
          <?=form_input(array('class' => 'form-control', 'id' => 'location', 'name' => 'location')); ?>
          <span class="glyphicon  form-control-feedback"></span>
        </div>
			</div>
		</div>

		<div class = "row" >
			<div  class = "form-group col-md-6">
					<?=form_submit('submit','Submit',array('class' => 'btn btn-primary btn-lg btn-block form-buttons', 'id' => 'submit')); ?>
			</div>
			<div  class = "form-group col-md-6">
					<?=form_reset('reset','Reset',array('class' => 'btn btn-primary btn-lg btn-block form-buttons')); ?>
			</div>
		</div>

		<?=form_close(); ?>
	</div>
</div>
