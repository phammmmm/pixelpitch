<?php require 'header.php'; ?>
<div id="product_preview"></div>
<div id="product-grid">
	<div id="menu">
		<div class="txt-heading">Products</div>
		<div class="search">
				<input type="text" id="keyword" class ="searchBox" onkeyup="searchTee();" name="keyword" placeholder="Search Tee...">
		</div>
		<div class="txt-heading">Categories</div>
		<div id="vertical-menu">
			
		</div>
	</div>
	<div id="product-list">
	
	</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/product.js"></script>
<script>
	populateCategories();
	searchTee();
</script>
<?php require 'footer.php'; ?>