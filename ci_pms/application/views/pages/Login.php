<style type="text/css">
.btn-primary
{
	color:white !important;
	font-weight:normal !important;
	height: auto !important;
}
</style>
<?php echo validation_errors('<div class=error>','</div>');?>

<section id="form">
	<div class="container">
			<div class=" col-md-4 col-md-offset-4">
			<div class="login-form"><!--login form-->
			<h2>Login To Your Account</h2>
		<?php 
			$email_options = ['type'=>'email','name'=>'email','id'=>'email','placeholder'=>'Email','class'=>'form-control'];
			echo form_open('',['id'=>'loginform']); 
			//Email Field
			echo form_label('Email','email',['class'=>'sr-only']); 
			echo form_input($email_options);
			//Password Field
			echo form_label('Password','password',['class'=>'sr-only']); 
			echo form_password('password','',['id'=>'password','class'=>'form-control','placeholder'=>'Password']);
			echo "<hr />";
			//Submit And Recover Form Button Field
			echo form_button('recover','Recover',['class' => 'btn btn-primary pull-left','id'=>'recover','style'=>'width:auto;']);
			echo form_submit('login','Login',['class' => 'btn btn-primary pull-right','id'=>'login','style'=>'width:auto;']);
			echo form_close();
		?>
		</div>
		</div>
	</div>	
</section>
