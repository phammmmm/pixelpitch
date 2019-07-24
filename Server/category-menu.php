<ul class="nav nav-pills flex-column">
  	
    <?php
    require_once("../Server/ProductController.php");
    $controller = new ProductController();
    $catArray = $controller->findCategories();
    if (! empty($catArray)) {
      foreach($catArray as $key=>$value) {
    ?>  
        <li class="nav-item">
          <a class="nav-link cat_button" data-id="<?php echo $catArray[$key]["cat_id"];  ?>">
            <?php echo $catArray[$key]["cat_title"]; ?>
          </a>
        </li>
    <?php
      }
    }
    ?>
</ul>