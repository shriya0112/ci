<div class="container">
<br />
<a href="<?php echo base_url('user/addOrUpdateData') ?>"><button class="btn-sm btn-primary glyphicon glyphicon-plus">ADD</button></a>
<hr />
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Mobile Number</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<?php foreach($user_info as $key):?>
			<tbody>
				<tr>
					<td><?php  echo $key['name']; ?></td>
					<td><?php  echo $key['email']; ?></td>
					<td><?php  echo $key['mobile_number']; ?></td>
					<td class="text-center">
						<a href="<?php echo base_url('user/delete/'.aes256encrypt($key['id'])); ?>"><button class="btn-sm btn-danger glyphicon glyphicon-trash"></button></a>
						<a href="<?php echo base_url('user/addOrUpdateData/'.aes256encrypt($key['id'])); ?>"><button class="btn-sm btn-success glyphicon glyphicon-edit"></button></a>
						<a href="<?php echo base_url('user/showUserData/'.aes256encrypt($key['id'])); ?>"><button class="btn-sm btn-primary glyphicon glyphicon-eye-open"></button></a>
					</td>
				</tr>
			</tbody>
		<?php endforeach; ?>
	</table>
</div>