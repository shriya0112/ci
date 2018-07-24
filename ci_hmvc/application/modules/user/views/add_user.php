<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				<?php echo validation_errors('<div class="text-center text-danger"> ', '</div>');?>
				<h2>Create Your Account</small></h2>
				<hr class="colorgraph">
				<?php 	$attributes = array('class' => 'register-form', 'id' => 'adduser','role' => 'form');
                echo form_open('', $attributes); ?>
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
                        'value'			=> $this->input->post('name')
                        );
                    echo form_input($name);
                    ?>
				</div>
				<!-- Email Field -->
				<div class="form-group">
					<?php 
                    $email = array(
                        'name'          => 'email',
                        'id'            => 'email',
                        'class'			=> 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder' 	=> 'Email',
                        'type'			=> 'email',
                        'tabindex' 		=> '3',
                        'value'			=> $this->input->post('email')
                        );
                    echo form_input($email);
                    ?>
				</div>
				<!-- Password Field -->
				<div class="form-group">
					<?php 
                    $password = array(
                        'name'          => 'password',
                        'id'            => 'password',
                        'class'			=> 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder' 	=> 'Password',
                        'type'			=>	'password',
                        'tabindex' 		=> '3',
                        );
                    echo form_input($password);
                    ?>
				</div>
				<!-- Confirm Password Field -->
				<div class="form-group">
					<?php 
                    $confirmPassword = array(
                        'name'          => 'confirmPassword',
                        'id'            => 'confirmPassword',
                        'class'			=> 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder' 	=> 'Confirm Password',
                        'type'			=>	'password',
                        'tabindex' 		=> '3',
                        );
                    echo form_input($confirmPassword);
                    ?>
				</div>
				<!-- Mobile Number Field -->
				<div class="form-group">
					<?php 
                    $mobileNumber = array(
                        'name'          => 'mobileNumber',
                        'id'            => 'mobileNumber',
                        'class'			=> 'form-control input-lg',
                        'maxlength'     => '100',
                        'placeholder' 	=> 'Mobile Number',
                        'tabindex' 		=> '3',
                        'value'			=> $this->input->post('mobileNumber')
                        );
                    echo form_input($mobileNumber);
                    ?>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-12 col-md-3">
						<?php 
                        echo form_submit('addUser', 'ADD', array('class'=>'btn btn-primary btn-block btn-lg','tabindex'=>'7'));
                        ?>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>