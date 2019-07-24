<?php
  if(!isset($_SESSION)){
    session_start();
  }
	if (isset($_SESSION["cart_item"])) {
		$total_quantity = 0;
		$total_price = 0;
		?>
		<div class="table">
			<div class="theader">
				<div class="table_header">Name</div>
				<div class="table_header">Category</div>
				<div class="table_header">Quantity</div>
				<div class="table_header">Unit Price</div>
				<div class="table_header">Price</div>
				<div class="table_header">Remove</div>
			</div>	

				<?php
				foreach ($_SESSION["cart_item"] as $item) {
					$item_price = $item["quantity"] * $item["price"];
					?>
					<div class='table_row'>
					<div class='table_small'>
						<div class='table_cell'>Name</div>
						<div class='table_cell'><img src="<?php echo "../".$item["image"]; ?>" class="cart-item-image" /><br><?php echo $item["name"]; ?>
						</div>
					</div>
					<div class='table_small'>
						<div class='table_cell'>Category</div>
						<div class='table_cell'><?php echo $item["category"]; ?></div>
					</div>
					<div class='table_small'>
						<div class='table_cell'>Quantity</div>
						<div class='table_cell'><?php echo $item["quantity"]; ?></div>
					</div>
					<div class='table_small'>
						<div class='table_cell'>Unit Price</div>
						<div class='table_cell'><?php echo "$ " . $item["price"]; ?></div>
					</div>
					<div class='table_small'>
						<div class='table_cell'>Price</div>
						<div class='table_cell'><?php echo "$ " . number_format($item_price, 2); ?></div>
					</div>
					<div class='table_small'>
						<div class='table_cell'>Remove</div>
						<div class='table_cell'><a onClick="cartAction('remove','<?php echo $item["product_id"]; ?>')" class="btnRemoveAction"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
					</div>
					</div>
					<?php
					$total_quantity += $item["quantity"];
					$total_price += ($item["price"] * $item["quantity"]);
				}
				?>

				<div class='table_row'>

					<div class='table_small'>
						<div class='table_cell'></div>
						<div class='table_cell'>Total:</div>
					</div>
					<div class='table_small'>
							<div class='table_cell'></div>
							<div class='table_cell'></div>
					</div>
					<div class='table_small'>
						<div class='table_cell'>Total Quantity</div>
						<div class='table_cell'><?php echo $total_quantity; ?></div>
					</div>
					<div class='table_small'>
							<div class='table_cell'></div>
							<div class='table_cell'></div>
					</div>
					<div class='table_small'>
						<div class='table_cell'>Total Price</div>	
						<div class='table_cell'><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></div>
					</div>
					<div class='table_small'>
							<div class='table_cell'></div>
							<div class='table_cell'></div>
					</div>
			</div>
	
			</div>

	<?php
	} else {
		?>
		<div class="no-records">Your Cart is Empty</div>
	<?php
	}
	?>