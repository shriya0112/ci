<?php

 $email = $this->session->email;
$this->db->select('name,email,dob,gender,address,mobile_number');
$this->db->where('email',$email);
$query=$this->db->get('admin_info');
$arr=$query->result();

?>
<div class="col-md-offset-1 col-md-10">	
<table class="table table-bordered ">
	<tr>
		<th>Field</th>
		<th>Description</th>
	</tr>
	<tr>
	<th>Name</th>
		<td><?php echo $arr[0]->name; ?></td>
	</tr>
	<tr>
	<th>Email</th>
		<td><?php echo $arr[0]->email; ?></td>
	</tr>
	<tr>
		<th>Date Of Birth</th>
		<td><?php 
		$date = date('d-m-Y', strtotime($arr[0]->dob) );    
 		echo $date; ?></td>
	</tr>

	<tr>
		<th>Gender</th>
		<td><?php echo $arr[0]->gender; ?></td>
	</tr>
	<tr>
		<th>Address</th>
		<td><?php echo $arr[0]->address; ?></td>
	</tr>
		<tr>
		<th>Mobile Number</th>
		<td><?php echo $arr[0]->mobile_number; ?></td>
	</tr>
	<tr><td colspan="2"><a href="<?php echo base_url('index.php/pms/update'); ?>"><button class="btn-warning btn-sm">Edit</button></a></td></tr>
</table>
</div> 