<?php 
$this->db->select('pc_id,name,description');
$this->db->where('psc_id',$psc_id);
$query=$this->db->get('product_subcategories');
$arr=$query->result();
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
				<h2>Update Category</h2>
				<?php 
				$category_name = set_value('pc_name') == false ? $arr[0]->pc_id : set_value('pc_name');
				$name = set_value('name') == false ? $arr[0]->name : set_value('name');
				$description = set_value('description') == false ? $arr[0]->description : set_value('description');
				$textarea_options = array(
					'name' => 'description',
					'rows' => '5',
					'class'=>'form-control' ,
					'style' => 'margin:3%; margin-left:0% ',
					'placeholder'=>'Description',
					'value'=>$description
					);
				echo form_open_multipart("pms/scupdate/$psc_id",['id' => 'cvalidate']);
				echo form_dropdown('pc_name',$product_categories,$category_name,['class'=>'form-control']);
				echo form_label('Category Name','name',['class'=>'sr-only']);
				echo form_input('name',$name,['class'=>'form-control ','placeholder'=>'Name','id'=>'name']);
				echo form_label('Description','description',['class'=>'sr-only','id'=>'description']);
				echo form_textarea($textarea_options);
				echo form_submit('update_category','SAVE CHANGES',['class'=>'btn btn-primary pull-right','id'=>'update_category','style'=>'width:auto;']);
				echo form_close();
				?>
			</div>
		</div>
	</div>
</section>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.12.3.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/category_validate.js');?>"></script>
	</body>
</html>


