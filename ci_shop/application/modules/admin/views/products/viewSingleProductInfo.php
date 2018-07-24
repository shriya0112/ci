<div class="container">
	<table class="table table-bordered">
		<?php foreach ($product_info as $key) :?>
			<tbody>
				<tr>
					<th>Name</th>
					<td><?php  echo $key['name']; ?></td>
				</tr>
				<tr>
					<th>Description</th>
					<td><?php  echo $key['description']; ?></td>
				</tr>
				<tr>
					<th>Price</th>
					<td><?php  echo $key['price']; ?></td>
				</tr>
				<tr>
					<th>Discount</th>
					<td><?php  echo $key['discount']; ?></td>
				</tr>
				<tr>
					<th>Selling Price</th>
					<td><?php  echo $key['selling_price']; ?></td>
				</tr>
			</tbody>
		<?php endforeach; ?>
	</table>
	<a href="<?php echo base_url().'admin/product/ShowProductList'; ?>"><button class="btn-primary btn-sm">Go Back</button></a>
</div>