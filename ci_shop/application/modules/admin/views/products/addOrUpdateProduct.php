<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				<?php echo validation_errors('<div class="text-center text-danger"> ', '</div>');?>
				
			<?php 
			if (isset($this->session->error)) {
				echo "<div class='text-center text-danger'>".$this->session->error."</div>";
			}
			?>
				<?php if ($product_id != '') {
                    ?>
					<h2>Update Product Details</small></h2>
					<?php
                } else {
                    ?>
					<h2>Add New Product</small></h2>
					<?php
                } ?>
				<hr class="colorgraph">
				<?php 	$attributes = array('class' => 'register-form', 'id' => 'productform','role' => 'form');
				echo form_open('', $attributes); ?>
				<?php  foreach ($product_info as $key){
						$name = 	$key['name'];
						$description = 	$key['description'];
						$price = 	$key['price'];
						$discount = 	$key['discount'];
						$selling_price = 	$key['selling_price'];				
					}
					?>
					<!-- Name Field -->
					<div class="form-group">
						<?php 
						$name = array(
							'name'          => 'name',
							'id'            => 'name',
							'class'			=> 'form-control input-lg',
							'maxlength'     => '100',
							'placeholder' 	=> 'Name',
							'tabindex' 		=> '3',
							'value'			=> isset($name) ? $name : $this->input->post('name')
							);
						echo form_input($name);
						?>
					</div>

					<!-- Description Field -->
					<div class="form-group">
						<?php 
						$description = array(
							'name'          => 'description',
							'id'            => 'description',
							'class'			=> 'form-control input-lg',
							'maxlength'     => '100',
							'placeholder' 	=> 'Description',
							'tabindex' 		=> '3',
							'value'			=> isset($description) ? $description : $this->input->post('description'),
							);
						echo form_textarea($description);
						?>
					</div>
			
					<!-- Price Number Field -->
					<div class="form-group">
						<?php 
						$price = array(
							'name'          => 'price',
							'id'            => 'price',
							'class'			=> 'form-control input-lg',
							'maxlength'     => '100',
							'placeholder' 	=> 'Price',
							'tabindex' 		=> '3',
							'value'			=> isset($price) ? $price : $this->input->post('price'),
	
							);
						echo form_input($price);
						?>
					</div>
						<!-- Discount Field -->
					<div class="form-group">
						<?php 
						$discount = array(
							'name'          => 'discount',
							'id'            => 'discount',
							'class'			=> 'form-control input-lg',
							'maxlength'     => '100',
							'placeholder' 	=> 'Discount In (%)',
							'tabindex' 		=> '3',
							'value'			=> isset($discount) ? $discount : $this->input->post('discount'),
							);
						echo form_input($discount);
						?>
					</div>
					<p id="selling_price"><?php echo isset($selling_price) ? $selling_price : ''; ?></p>
				<hr>
				<div class="row">
					<div class="col-xs-12 col-md-3">
						<?php 
						echo form_submit('updateUser', 'SAVE', array('class'=>'btn btn-primary btn-lg','tabindex'=>'7'));
						?>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>
