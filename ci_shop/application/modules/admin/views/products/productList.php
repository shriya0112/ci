<div class="container">
<br />
<a href="<?php echo base_url('admin/product/AddOrUpdateProduct/') ?>"><button class="btn-sm btn-primary glyphicon glyphicon-plus">ADD</button></a>
<hr />
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Discount(%)</th>
				<th>Selling Price</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<?php foreach($product_info as $key):?>
			<tbody>
				<tr>
					<td><?php  echo $key['name']; ?></td>
					<td style="width:40%"><?php  echo $key['description']; ?></td>
					<td><?php  echo $key['price']; ?></td>
					<td><?php  echo $key['discount']; ?></td>
					<td><?php  echo $key['selling_price']; ?></td>
					<td class="text-center">
						<a href="<?php echo base_url('admin/product/DeleteProductData/'.aes256encrypt($key['product_id'])); ?>"><button class="btn-sm btn-danger glyphicon glyphicon-trash"></button></a>
						<a href="<?php echo base_url('admin/product/AddOrUpdateProduct/'.aes256encrypt($key['product_id'])); ?>"><button class="btn-sm btn-success glyphicon glyphicon-edit"></button></a>
						<a href="<?php echo base_url('admin/product/ShowProductData/'.aes256encrypt($key['product_id'])); ?>"><button class="btn-sm btn-primary glyphicon glyphicon-eye-open"></button></a>
					</td>
				</tr>
			</tbody>
		<?php endforeach; ?>
	</table>
</div>