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









