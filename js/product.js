$(".quick_look").on("click", function() {
  var product_id = $(this).attr("data-id");
  var options = {
      modal: true,
      height: 'auto',
      width:'70%'
    };
  $('#product_preview').load('get-product-info.php?product_id='+product_id).dialog(options).dialog('open');
});


$(".cat_button").on("click", function() {
  var cat_id = $(this).attr("data-id");
  $('#product-list').load('category.php?cat_id='+cat_id);
});



