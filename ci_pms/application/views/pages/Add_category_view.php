<section id="form"><!--form-->
	<div class="container">
		<div class="col-sm-7" >
			<ul class="col-sm-offset-1" >
				<?php echo validation_errors('<li class="error1">','</li>');?>
			</ul>
		</div>
		<div class=" col-md-offset-2 col-md-8 ">
			<div class="login-form"><!--login form-->
				<h2>Add Category</h2>
				<?php 
				$textarea_options = array(
					'name' => 'description',
					'rows' => '5',
					'class'=>'form-control' ,
					'style' => 'margin:3%; margin-left:0% ',
					'placeholder'=>'Description',
					);
				echo  form_open_multipart('pms/cadd',['id' => 'cvalidate']);
				echo form_label('Category Name','name',['class'=>'sr-only']);
				echo form_input('name','',['class'=>'form-control ','placeholder'=>'Name','id'=>'name']);
				echo form_label('Description','description',['class'=>'sr-only','id'=>'description']);
				echo form_textarea($textarea_options);
				
				echo form_submit('add_category','ADD',['class'=>'btn btn-primary pull-right','id'=>'add_category','style'=>'width:auto;']);
				echo form_close();
				?>
			</div>
		</div>
	</div>
</section><!--/form-->
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.12.3.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/category_validate.js');?>"></script>
 	
	</body>
</html>

