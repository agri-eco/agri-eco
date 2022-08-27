<form class="form-inline justify-content-center mt-5" id="search-form">
	<div class="input-group">
		<input class="form-control form " type="search" pattern="([À-ža-zA-Z0-9\s]+){2,}" placeholder="Product Search" aria-label="Search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>" aria-describedby="button-addon2">
		<div class="input-group-append">
			<button class="btn btn-outline-success btn-sm m-0" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
		</div>
	</div>
</form>

<div class="container px-4 px-lg-5 mt-5">
	<div class="row gx-4 gx-lg-5 row-cols-md-3 row-cols-xl-4 justify-content-center">
		<?php
		$products = $conn->query("SELECT p.*,i.quantity FROM products p inner join inventory i on p.id=i.product_id where i.quantity > 0 and p.status = 1 order by rand() ");
		while ($row = $products->fetch_assoc()) :
			$upload_path = base_app . '/uploads/product_' . $row['id'];
			$img = "";
			if (is_dir($upload_path)) {
				$fileO = scandir($upload_path);
				if (isset($fileO[2]))
					$img = "uploads/product_" . $row['id'] . "/" . $fileO[2];
				// var_dump($fileO);
			}
			foreach ($row as $k => $v) {
				$row[$k] = trim(stripslashes($v));
			}
			$inventory = $conn->query("SELECT * FROM inventory where product_id = " . $row['id']);
			$inv = array();
			while ($ir = $inventory->fetch_assoc()) {
				$inv[] = isset($ir['price']) ? number_format($ir['price'], 2) : 0.00;
			}
		?>
			<div class="col mb-5">
				<div class="card product-item h-100">
					<!-- Product image-->
					<img class="card-img-top p-1 w-100" src="<?php echo validate_image($img) ?>" height="200rem" style="object-fit:cover" alt="..." />
					<!-- Product details-->
					<div class="card-body p-4">
						<div class="">
							<!-- Product name-->
							<h5 class="fw-bolder"><?php echo $row['product_name'] ?></h5>
							<!-- Product price-->
							<?php foreach ($inv as $k => $v) : ?>
								<span><b>Price: </b><?php echo "₱ ", isset($v) ? number_format($v, 2) : 0.00 ?></span>
							<?php endforeach; ?>
						</div>
						<p class="m-0"><small>By: <?php echo $row['department'] ?></small></p>
					</div>
					<!-- Product actions-->
					<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
						<div class="text-center">
							<a class="btn btn-flat btn-primary " href=".?p=view_product&id=<?php echo md5($row['id']) ?>">View</a>
						</div>

					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
</div>
<script>
	$(function() {
		$('#search-form').submit(function(e) {
			e.preventDefault()
			var sTxt = $('[name="search"]').val()
			if (sTxt != '')
				location.href = './?p=products&search=' + sTxt;
		})
	})
</script>