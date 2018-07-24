[<section id="form"><!--form-->
<div class="container">
<div class="col-sm-7" >
	<ul class="col-sm-offset-1" >
		<?php echo validation_errors('<li class="error1">','</li>');?>
	</ul>
</div>
<div class=" col-md-offset-2 col-md-8 ">
	<div class="login-form"><!--login form-->
		<h2>Add Product</h2>
		<?php 
		$textarea_options = array(
			'name' => 'description',
			'rows' => '5',
			'class'=>'form-control' ,
			'style' => 'margin:3%; margin-left:0% ',
			'placeholder'=>'Description',
			);
//array_unshift($product_subcategories, 'Select Sub-category');
		array_unshift($product_categories,'Select Category');
		echo  form_open_multipart('pms/padd',['id' => 'pvalidate']);
		echo form_label('Category Name','pc_name',['class'=>'sr-only']);
		$js = 'id="pc_name" class="form-control" ';
		echo form_dropdown('pc_name',$product_categories,'0',$js);
		echo form_label('Sub-Category Name','psc_name',['class'=>'sr-only']);
		echo form_dropdown('psc_name','Select Sub-Category','0',['class'=>'form-control ','id'=>'psc_name']);
		echo form_label('Product Name','name',['class'=>'sr-only']);
		echo form_input('name','',['class'=>'form-control ','placeholder'=>'Name','id'=>'name']);
		echo form_label('Description','description',['class'=>'sr-only','id'=>'description']);
		echo form_textarea($textarea_options);
		echo form_label('Image','image_name1',['class'=>'sr-only']);
		echo form_upload('image_name1');
		echo form_label('Additional Image','image_name[]',['class'=>'sr-only']);
		echo form_upload('image_name[]','','multiple');
		echo form_label('Actual Price','actual_price',['class'=>'sr-only']);
		echo form_input('actual_price','',['class'=>'form-control','placeholder'=>'Actual Price In Rupees','id'=>'actual_price']);
		echo form_label('Discount Percentage','discount_in_percentage',['class'=>'sr-only']);
		echo form_input('discount_in_percentage','',['class'=>'form-control','placeholder'=>'Discount Percentage','id'=>'discount_in_percentage']);
		echo form_label('Final Price','final_price',['class'=>'sr-only']);
		echo form_input('final_price','',['class'=>'form-control','placeholder'=>'Final Price','id'=>'final_price']);
		echo form_label('Brand Name','brand_name',['class'=>'sr-only']);
		echo form_input('brand_name','',['class'=>'form-control','placeholder'=>'Brand Name','id'=>'brand_name']);
		echo form_label('Seller Name','seller_name',['class'=>'sr-only']);
		echo form_input('seller_name','',['class'=>'form-control','placeholder'=>'Seller Name','id'=>'seller_name']);
		echo form_submit('add_subcategory','ADD',['class'=>'pull-right','id'=>'add_subcategory']);
		echo form_close();
		?>
	</div>
</div>
</div>
</section><!--/form-->
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.12.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/product_validate.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/change_category.js'); ?>"></script>]