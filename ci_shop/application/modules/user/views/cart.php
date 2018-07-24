<div class="container">
	<table id="cart" class="table table-hover table-condensed">
		<thead>
			<tr>
				<th style="width:50%">Product</th>
				<th style="width:12%">Price</th>
				<th style="width:6%">Quantity</th>
				<th style="width:22%" class="text-center">Subtotal</th>
				<th style="width:10%"></th>
			</tr>
		</thead>
		<tbody>
			<?php 
            $total = 0;
            foreach ($result as $key) {
                ?>
				<tr>
					<td data-th="Product">
						<div class="row">
							<div class="col-sm-3 hidden-xs"><img style="width=100px; height:100px" src="<?php echo base_url(); ?>/assets/user/shop/<?php echo $key['cover_image']; ?>" alt="Product-Image" class="img-responsive"/></div>
							<div class="col-sm-9">
								<h4 class="nomargin"><?php echo $key['name']; ?></h4>
								<p><?php echo $key['description']; ?></p>
							</div>
						</div>
					</td>
					<td data-th="Price">&#x20B9;<?php echo $key['selling_price']; ?></td>
					<td data-th="Quantity">
						<input type="number" id="quantity<?php echo aes256encrypt($key['product_id']); ?>" name="quantity" class="form-control text-center" value="<?php echo $key['quantity']; ?>">
					</td>
					<td data-th="Subtotal" class="text-center"><?php echo $key['quantity'] * $key['selling_price']; ?></td>
					<td class="actions" data-th="">
						<button data-id="<?php echo aes256encrypt($key['product_id']); ?>"  class="btn btn-success btn-cart-update btn-sm"><i class="fa fa-pencil"></i></button>
						<button data-id="<?php echo aes256encrypt($key['product_id']); ?>" class="btn btn-danger btn-cart-delete btn-sm"><i class="fa fa-trash-o"></i></button>								
					</td>
				</tr>
				<?php 
                $total += $key['quantity'] * $key['selling_price'];
            }
            ?>
		</tbody>
		<tfoot>
			<tr class="visible-xs">
				<td class="text-center"><strong>Total &#x20B9;<?php echo $total;?></strong></td>
			</tr>
			<tr>
				<td><a href="<?php echo base_url(); ?>/user/home" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
				<td colspan="2" class="hidden-xs"></td>
				<td class="hidden-xs text-center"><strong>Total &#x20B9;<?php echo $total;?></strong></td>
				<td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
			</tr>
		</tfoot>
	</table>
</div>
