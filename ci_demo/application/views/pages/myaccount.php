<div class="container">
	<h1>My Account</h1>
	<?php 
	$attributes = array('class' => 'loginform', 'id' => 'myform','role' => 'form');
	echo form_open(base_url().'welcome/myAccountSubmit', $attributes);
	?>

	<?php 
	foreach($myaccountdetails as $v): ?>
	<table class="table table-striped">
		<tbody>
			<tr>
				<th><h4><?php echo form_label('First Name', 'firstname'); ?></h4></th>
				<td> <?php 
					$firstname = $this->input->post('firstname')? $this->input->post('firstname') : ucwords($v['firstname']);
					$firstnameOptions = ['type'=>'text','name'=>'firstname','id'=>'firstname','value'=>$firstname,'class'=>'form-control  input-lg', 'tabindex'=>'4'];
					echo form_input($firstnameOptions); ?>
				</td>
			</tr>
			<tr>
				<th><h4><?php echo form_label('Last Name', 'lastname'); ?></h4></th>
				<td> <?php 
					$lastname = $this->input->post('lastname')? $this->input->post('lastname') : ucwords($v['lastname']);
					$lastnameOptions = ['type'=>'text','name'=>'lastname','id'=>'lastname','value'=>$lastname,'class'=>'form-control  input-lg', 'tabindex'=>'4'];
					echo form_input($lastnameOptions); ?>
				</td>
			</tr>
			<tr>
				<th><h4><?php echo form_label('Email', 'email'); ?></h4></th>
				<td> <?php 
					$email = $this->input->post('email')? $this->input->post('email') : ucwords($this->session->email);
					$emailOptions = ['type'=>'text','name'=>'email','id'=>'email','value'=>$email,'class'=>'form-control  input-lg', 'disabled'=>'disabled','tabindex'=>'4'];
					echo form_input($emailOptions); ?>
				</td>
			</tr>
			<tr>
				<td class="col-sm-1">
					<?php echo form_submit('update', 'SAVE CHANGES', ['class' => 'btn btn-primary btn-block btn-sm','id'=>'update']); ?>
				</td>
			</tr>
		</tbody>
	<?php endforeach; ?>
</table>
<?php echo form_close(); ?>
</div>