<style type="text/css">
	.panel-group {
		margin: 0px !important;
		padding: 0px !important;
	}
	.panel-body {
		padding: 0.05px !important;
		margin: 0px !important;
		line-height: 0.5;
	}
	.brands_products h2{
		padding-top: 30px !important;
	}
</style>
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<!--category-productsr-->
					<?php
					$i=0;
					if($i < count($categories))
					{							
						foreach ($categories as $value) {
							?>
							<div class="panel-group category-products" id="accordian">					
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $categories[$i]->pc_id; ?>">
												<span class="badge pull-right"><i class="fa fa-plus"></i></span>
												<?php echo $categories[$i]->name; ?>
											</a>
										</h4>
									</div>
									<div id="<?php echo $categories[$i]->pc_id; ?>" class="panel-collapse collapse">
										<div class="panel-body">

											<ul>
												<li><a href="#"></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div> <!--/category-products-->
							<?php
							$i++;
# code...
						}
					}
					?>
				</div>
			</div>

			

			
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Features Items</h2>
									<?php foreach ($products->result() as $r) { ?>
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
							
									<img style="height:300px; width:200px" src="<?php echo base_url('/images/').$r->image_name; ?>"
									 alt="Demo Image" />
									<h2>&#x20B9;<?php echo $r->final_price ?></h2>
									<a href="product_detail_view.php?wid="><p></p></a>				
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
							</div>
						
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
								</ul>
							</div>
						</div>
					</div>
										<?php  } ?>
				</div><!--features_items-->

			</div>
		</div>
	</div>
</section>

	</body>
</html>
