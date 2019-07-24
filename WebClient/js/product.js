$(".quick_look").on("click", function() {
  var product_id = $(this).attr("data-id");
  var options = {
      modal: true,
      height: 'auto',
      width:'70%'
    };
  var url = window.location.href;
  var pos = url.lastIndexOf("/");
  url = url.substring(0,pos)
  $('#product_preview').load(url+'/../Server/get-product-info.php?product_id='+product_id).dialog(options).dialog('open');
});
$(".cat_button").on("click", function() {
  var cat_id = $(this).attr("data-id");
  var url = window.location.href;
  var pos = url.lastIndexOf("/");
  url = url.substring(0,pos)
  $('#product-list').load(url+'/../Server/category.php?cat_id='+cat_id);
});

function searchTee(){
  var url = window.location.href;
  var pos = url.lastIndexOf("/");
  url = url.substring(0,pos)

  $('#product-list').load(url+'/../Server/searchProducts.php?keyword='+$('#keyword').val());
}

function populateCategories(){
  var url = window.location.href;
  var pos = url.lastIndexOf("/");
  url = url.substring(0,pos);

  $('#vertical-menu').load(url+'/../Server/category-menu.php');
}

function populateCart(){
  var url = window.location.href;
  var pos = url.lastIndexOf("/");
  url = url.substring(0,pos);
  $('#cart-items').load(url+'/../Server/cart-listing.php');
}
function cartAction(action,product_code) {
  var url1 = window.location.href;
  var pos = url1.lastIndexOf("/");
  url1 = url1.substring(0,pos)+"/../Server/cart-action.php";
  
  var queryString = "";
	if(action != "") {
		switch(action) {
			case "add":
				queryString = 'action='+action+'&product_id='+ product_code+'&quantity='+$("#qty_"+product_code).val();
			break;
			case "remove":
        queryString = 'action='+action+'&product_id='+ product_code;
			break;
			case "empty":
        queryString = 'action='+action;
			break;
		}	 
	}
	jQuery.ajax({
    url: url1,
    data:queryString,
    type: "GET",
    success: function(){
      if(action == "add"){ 
        alert("Item has been added to cart.");
      }else{
        populateCart();
      }
    },
    error: function(){
      alert("Something went wrong. Try again later.");
    }
  });
}

function placeOrder(){
  var url1 = window.location.href;
  var pos = url1.lastIndexOf("/");
  url1 = url1.substring(0,pos)+'/../Server/orders.php';
  var queryString = "";
 
  jQuery.ajax({
    url: url1,
    data:queryString,
    type: "POST",
    success: function(result){
      $('#checkout').html(result);
    },
    error: function(){
      alert("Something went wrong. Try again later.");
    }
  });
}











