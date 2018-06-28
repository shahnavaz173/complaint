<div class="container-login add-category">

	<div class="row">

		<div class="col-md-4 col-md-offset-1"  style="background-color:#FFF;margin-top:5em;margin-bottom:5em;">
			<div class="row">
				<div class="jumbotron jumbotron-box" style="padding:0.5em">
					<h3 style="color:#FFF">Add Common Complaint</h3>
				</div>
			</div>
			<?=form_open('Complaint/add_common_complaint');?>
			<div class="row">
				<div class="form-group col-md-10 col-md-offset-1">
          <label for="category">Complaint Category : </label>
					<select name="category" class="form-control complaintype">
						<option value="">Select Category</option>
						<?php foreach ($complain_caategory as $category): ?>
							<option value="<?php echo $category->cate_id; ?>"><?php echo $category->category; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

      <div class="row">
				<div class="form-group col-md-10 col-md-offset-1">
          <label for="cdescription">Complaint Description :</label>
  				<div class="input-group">
  					<div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
  						<?=form_textarea(array('class' => 'form-control', 'rows' => '2', 'name' => 'cdescription','id' => 'cdescription', 'placeholder' => 'Fan not working',  'required' => 'required')); ?>
  						<span class="glyphicon  form-control-feedback"></span>
  				</div>
				</div>
			</div>

      <div class="row">
  			<div class="form-group col-md-10 col-md-offset-1">
  				<label for="gender">For Whom:</label>
  					<div class="radio-inline">
              <input type="radio" name="forwhom" id="forall" required="required" class="gender" value="1" />
              For All
  					</div>
        		<div class="radio-inline">
              <input type="radio" name="forwhom" id="forCampus" required="required" class="gender"  value="2"/>
              For campus only
  					</div>
  			</div>
  		</div>

			<div class = "row" >
				<div  class = "form-group col-md-10 col-md-offset-1">
						<?=form_submit('submit','Submit',array('class' => 'btn btn-primary btn-md btn-block form-buttons')); ?>
				</div>
			</div>
			<?=form_close(); ?>
		</div>

		<div class="col-md-4 col-md-offset-1" style="background-color:#FFF;margin-top:5em;margin-bottom:5em;" >
			<div class="row">
				<div class="jumbotron jumbotron-box" style="padding:0.5em">
					<h3 style="color:#FFF">Add New Category</h3>
				</div>
			</div>
			<?=form_open(base_url('Complaint/add_complaint_category'));?>

			<div class="row em">
				<div class = "form-group col-md-10 col-md-offset-1 ">
					<label for = "category">Enter Category :
					<div class = "input-group " >
						<div class = "input-group-addon"><i class = "glyphicon glyphicon glyphicon-list"></i></div>
						<?=form_input(array('name' => 'ccategory', 'id' => 'ccategory','placeholder' => 'Electrical', 'class' => 'form-control', 'required' => 'true')); ?>
						<div class = "glyphicon  form-control-feedback"></div>
					</div>
					</label>
					<!--<h4 class = "bg-danger text-danger error-msg" id = "em-err"><span class = "glyphicon glyphicon-exclamation-sign"></span> Enter Valid E-mail!</h4> -->
				</div>
			</div>
			<div class = "row next" >
				<div  class = "form-group col-md-10 col-md-offset-1">
						<?=form_submit('submit','Submit',array('id' => 'submit','class' => 'btn btn-primary btn-md btn-block form-buttons')); ?>
				</div>
			</div>
			<?=form_close();?>
		</div>
</div>
