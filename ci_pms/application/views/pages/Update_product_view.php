<?php 
$this->db->select('pc_id,psc_id,p_id,name,description,image_name,actual_price,discount_in_percentage,final_price,seller_name,brand_name');
$this->db->where('p_id',$p_id);
$query=$this->db->get('product_information');
$arr = $query->result();

?>
<section id="form"><!--form-->
	<div class="container">
		<div class="col-sm-7" >
			<ul class="col-sm-offset-1" >
				<?php echo validation_errors('<li class="error1">','</li>');?>
			</ul>
		</div>
		<div class=" col-md-offset-2 col-md-8 ">
			<div class="login-form"><!--login form-->
				<h2>Update Product</h2>
				<?php
				$category_name = set_value('pc_id') == false ? $arr[0]->pc_id : set_value('pc_id');
				$subcategory_name = set_value('psc_id') == false ? $arr[0]->psc_id : set_value('psc_id');
				$name = set_value('name') == false ? $arr[0]->name : set_value('name');
				$description = set_value('description') == false ? $arr[0]->description : set_value('description');			
				$image_name = set_value('image_name') == false ? $arr[0]->image_name : set_value('image_name');
				$actual_price = set_value('actual_price') == false ? $arr[0]->actual_price : set_value('actual_price');
				$discount_in_percentage = set_value('discount_in_percentage') == false ? $arr[0]->discount_in_percentage : set_value('discount_in_percentage');
				$final_price = set_value('final_price') == false ? $arr[0]->final_price : set_value('final_price');
				$seller_name = set_value('seller_name') == false ? $arr[0]->seller_name : set_value('seller_name');
				$brand_name = set_value('brand_name') == false ? $arr[0]->brand_name : set_value('brand_name');
				$images_options = array(        
					'name' => 'userfile',  
					'value' => 'uploads/'.$image_name         
					);
				$textarea_options = array(
					'name' => 'description',
					'rows' => '5',
					'class'=>'form-control' ,
					'style' => 'margin:3%; margin-left:0% ',
					'placeholder'=>'Description',
					'value' => $description
					);
//array_unshift($product_subcategories, 'Select Sub-category');
				array_unshift($product_categories,'Select Category');
				echo  form_open_multipart('pms/pupdate/'.$p_id,['id' => 'pvalidate']);
				echo form_label('Category Name','pc_name',['class'=>'sr-only']);
				$js = 'id="pc_name" class="form-control" ';
				echo form_dropdown('pc_name',$product_categories,$category_name,$js);
				echo form_label('Sub-Category Name','psc_name',['class'=>'sr-only']);
				?>
				<select name="psc_name" class="form-control " id="psc_name">
					<?php 
					$category_id = $arr[0]->pc_id;
					$this->load->model('Pms_model');
					$data['product_subcategories']=$this->Pms_model->getSubcategoriesByCategory($category_id);  
					foreach ($data['product_subcategories'] as $row)  
					{   
						if($row->psc_id > 0)
						{
//here we build a dropdown item line for each query result  
							if($row->psc_id==$arr[0]->psc_id)
							{
								echo '<option value='.$row->psc_id.' selected >'.$row->name.'</option>';  
							}
							else
							{
								echo "<option value='".$row->psc_id."' >".$row->name."</option>";  
							}
						}
						else{
							echo	 "<option value='0'>Select Sub-Category</option>";  
						}
					} ?>
				</select>
				<?php 
				echo form_label('Product Name','name',['class'=>'sr-only']);
				echo form_input('name',$name,['class'=>'form-control ','placeholder'=>'Name','id'=>'name']);
				echo form_label('Description','description',['class'=>'sr-only','id'=>'description']);
				echo form_textarea($textarea_options);
				echo form_label('Actual Price','actual_price',['class'=>'sr-only']);
				echo form_input('actual_price',$actual_price,['class'=>'form-control','placeholder'=>'Actual Price In Rupees','id'=>'actual_price']);
				echo form_label('Discount Percentage','discount_in_percentage',['class'=>'sr-only']);
				echo form_input('discount_in_percentage',$discount_in_percentage,['class'=>'form-control','placeholder'=>'Discount Percentage','id'=>'discount_in_percentage']);
				echo form_label('Final Price','final_price',['class'=>'sr-only']);
				echo form_input('final_price',$final_price,['class'=>'form-control','placeholder'=>'Final Price','id'=>'final_price']);
				echo form_label('Brand Name','brand_name',['class'=>'sr-only']);
				echo form_input('brand_name',$brand_name,['class'=>'form-control','placeholder'=>'Brand Name','id'=>'brand_name']);
				echo form_label('Seller Name','seller_name',['class'=>'sr-only']);
				echo form_input('seller_name',$seller_name,['class'=>'form-control','placeholder'=>'Seller Name','id'=>'seller_name']);
				echo form_submit('update_product','SAVE CHANGES',['class'=>'pull-right','id'=>'update_product']);
				echo form_close();
				?>
			</div>
		</div>
	</div>
</section>
</form>
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.12.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){  
		$("#pc_name").change(function(){  
			var id=$(this).val();
			/*dropdown post  */
			$.ajax({  
				url:"<?php echo base_url("index.php/pms/sc/"); ?>"+id,  
				data: {id:$(this).val()},  
				type: "POST",  
				success:function(response){  
					$("#psc_name").html(response);  
				},
				error:function(response)
				{
					$("#psc_name").html(response);  
				}  
			});  
		});  
	});   
</script>
</body>
</html>