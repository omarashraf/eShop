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

  <title>Description</title>
</head>
<body>

  <!-- Nav bar -->
    <div class="contain-to-grid sticky">
      <nav style="color: white;" class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
        <ul class="inline-list" style="margin-top: 10px;">
          <li style="padding-right: 60px;"><a style="color: white;" href="#">eShop</a></li>
          <li style="padding-right: 20px;"><a href="#
            ">Home</a></li>
          <li style="padding-right: 20px;"><a href="productshome.php">Products</a></li>
          <li style="padding-right: 20px;"><a href="#">Profile</a></li>
          <li style="margin-top: -7.5px; font-size: 26px;"><a href="#"><i class="fi-shopping-cart"></i></a></li>
        </ul>
      </nav>
    </div>
    <br>

<!-- Left nav -->
  <div class="small-3 columns">
    <?php
      echo "<a class=\"th\" href=\"#\"><img src=\"img/default-placeholder.png\"></a>";
    ?>
  </div>

<!-- Right nav -->
  <div style="margin-left: 0px;" class="small-4 columns">
    <?php
      include('helper.php');
      if ($_GET) {
        $product = getProduct($_GET['id']);
        echo "<b>Name: </b>" . $product['pName'] . "<br>";
        echo "<b>Category: </b>" . $product['catId'] . "<br>";
        //echo $product['photo'] . "<br>";
        echo "<b>Price: </b>$" . $product['price'] . "<br>";
        echo "<b>Rating: </b>" . $product['rating'] . "<br>";
        echo "<b>Stock: </b>" . $product['stock'] . "<br>";
        echo "<b>Description: </b>" . $product['description'] . "<br>";
        echo "<a href=\"#\" class=\"button tiny alert\">Add to cart</a>";
      }
    ?>
  </div>

  <script>
    $(document).foundation();
  </script>

</body>
</html>
