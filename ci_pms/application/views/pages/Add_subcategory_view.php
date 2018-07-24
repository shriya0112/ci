<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-7 col-sm-offset-2" >
				<ul class="col-sm-offset-1" >
					<?php echo validation_errors('<li class="error1">','</li>');?>
				</ul>
			</div>
			<div class = "col-sm-7 col-sm-offset-2">
				<div class="login-form"><!--login form-->
					<h2>Add Sub-Category</h2>
					<?php 
					$textarea_options = array(
						'name' => 'description',
						'rows' => '5',
						'class'=>'form-control' ,
						'style' => 'margin:3%; margin-left:0% ',
						'placeholder'=>'Description',
						);
					array_unshift($product_categories, 'Select Category');
					echo form_open('pms/scadd');
					echo form_dropdown('pc_name',$product_categories,'',['class'=>'form-control']);
					echo form_label('Name','name',['class'=>'sr-only']);
					echo form_input('name','',['class'=>'form-control','placeholder'=>'Name']);
					echo form_label('Description','description',['class'=>'sr-only']);
					echo form_textarea($textarea_options);
					echo form_submit('add_subcategory','ADD',['class'=>'btn btn-primary pull-right','id'=>'add_subcategory','style'=>'width:auto;']);
					?>
				</div>
			</div>
		</div>
	</div>
</section><!--/form-->
