<div class="container">
	<table class="table table-bordered">
		<?php foreach($user_info as $key) :?>
			<tbody>
				<tr>
				<th>Name</th>
					<td><?php  echo $key['name']; ?></td>
					</tr>
					<tr>
					<th>Email</th>
					<td><?php  echo $key['email']; ?></td>
					</tr>
					<tr>
					<th>Mobile Number</th>
					<td><?php  echo $key['mobile_number']; ?></td>
				</tr>
			</tbody>
		<?php endforeach; ?>
	</table>
	<a href="<?php echo base_url().'user'; ?>"><button class="btn-primary btn-sm">Go Back</button></a>
</div>