<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/foundation-icons.css">

  <script src="js/vendor/jquery.js"></script>
  <script src="js/vendor/modernizr.js"></script>
  <script src="js/vendor/placeholder.js"></script>
  <script src="js/vendor/fastclick.js"></script>
  <script src="js/foundation.min.js"></script>
  <script>
  $(document).foundation();
  </script>

  <title>Products</title>
</head>
<body>

<!-- Nav bar -->
  <div class="contain-to-grid sticky">
    <nav style="color: white;" class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
      <ul class="inline-list" style="margin-top: 10px;">
        <li style="padding-right: 60px;"><a style="color: white;" href="#">eShop</a></li>
        <li style="padding-right: 20px;"><a href="#">Home</a></li>
        <li style="padding-right: 20px;"><a href="#">Products</a></li>
        <li style="padding-right: 20px;"><a href="#">Profile</a></li>
        <li style="margin-top: -7.5px; font-size: 26px;"><a href="#"><i class="fi-shopping-cart"></i></a></li>
      </ul>
    </nav>
  </div>
  <br>


<!-- Left nav -->
  <!-- Categories -->
  <div style="background: #f2f2f2;" class="small-3 columns">Categories
    <?php
      include('helper.php');
      $array = array(
        'name' => array(),
        'id' => array()
      );
      $array = categories();

      $i = 0;
      echo '<ul><li><a href="productshome.php?cat=0">All</a></li>';
			while ($i < sizeof($array['name'])) {
				echo "<li><a href=\"productshome.php?cat=" . $array['id'][$i] . "\">" . $array['name'][$i] . "</a></li>";
				$i++;
			}
      echo '</ul>';
    ?>
  </div>

<!-- Right nav -->
  <div style="margin-left: 40px;" class="small-8 columns">

  <!-- Search -->
    <a href="#" style="border-radius: 25px;" class="button tiny success left inline">Search <i class="fi-magnifying-glass"></i></a>
    <div class="large-10 columns">
      <input style="border-radius: 25px; height: 33px;" type="text" />
    </div>

  <!-- Blocks -->
    <?php
      // include('helper.php');
      $array = array(
        'name' => array(),
        'price' => array(),
        'stock' => array(),
        'cat' => array()
      );
      $array = products();

      $i = 0;
      echo '<ul class="small-block-grid-3">';
      while ($i < sizeof($array['name'])) {
        if ($_GET){
          if ($array['cat'][$i] == $_GET['cat']) {
            echo "<li>" . $array['name'][$i] . "<a class=\"th\" href=\"#\"><img src=\"img/default-placeholder.png\"></a> $" . $array['price'][$i] . "<div style=\"float: right;\">Stock: " . $array['stock'][$i] . "</div><br><a href=\"#\" class=\"button tiny alert\">Add to cart</a></li>";
          }
          elseif ($_GET['cat'] == 0) {
            echo "<li>" . $array['name'][$i] . "<a class=\"th\" href=\"#\"><img src=\"img/default-placeholder.png\"></a> $" . $array['price'][$i] . "<div style=\"float: right;\">Stock: " . $array['stock'][$i] . "</div><br><a href=\"#\" class=\"button tiny alert\">Add to cart</a></li>";
          }
        }
        else {
          echo "<li>" . $array['name'][$i] . "<a class=\"th\" href=\"#\"><img src=\"img/default-placeholder.png\"></a> $" . $array['price'][$i] . "<div style=\"float: right;\">Stock: " . $array['stock'][$i] . "</div><br><a href=\"#\" class=\"button tiny alert\">Add to cart</a></li>";
        }
        $i++;
      }
    ?>
  </div>

<!-- Pagination -->
  <div class="row">
    <div class="pagination-centered">
      <ul class="pagination">
        <li class="arrow unavailable"><a href="">&laquo;</a></li>
        <li class="current"><a href="">1</a></li>
        <li><a href="">2</a></li>
        <li><a href="">3</a></li>
        <li><a href="">4</a></li>
        <li class="unavailable">&hellip;</li>
        <li><a href="">12</a></li>
        <li><a href="">13</a></li>
        <li class="arrow"><a href="">&raquo;</a></li>
      </ul>
    </div>
  </div>

</body>
</html>
