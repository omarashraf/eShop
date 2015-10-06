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

  <?php
    session_start();

    include('helper.php');
    if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin_password'])) {
      $user_id = $_SESSION['loggedin'];
    }
    else {
      $user_id = 0;
    }
  ?>

  <!-- Nav bar -->
    <div class="contain-to-grid sticky">
      <nav style="color: white;" class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
        <ul class="inline-list" style="margin-top: 10px;">
          <li style="padding-right: 60px;"><a style="color: white;" href="productshome.php">eShop</a></li>
          <li style="padding-right: 20px;"><a href="productshome.php">Products</a></li>
          <li style="padding-right: 20px;"><a href="editProfile.php">Profile</a></li>
          <li style="margin-top: -7.5px; font-size: 26px;"><a href="cart.php"><i class="fi-shopping-cart"></i></a></li>
          <?php
              if (isset($_SESSION['loggedin'])) {
                $select_users_sql = "SELECT * FROM users WHERE id = '" . $_SESSION['loggedin'] . "'";
                $res = mysql_query($select_users_sql);
                if (mysql_num_rows($res)) {
                  while ($temp = mysql_fetch_assoc($res)) {
                    if ($temp['id'] == $_SESSION['loggedin']) {
                      $current_user = $temp['first_name'];
                    }
                  }
                }
                else {
                  die (mysql_error());
                }
                echo "<li style=\"margin-top: -11px; float: right;\">
                        <button href=\"#\" data-dropdown=\"drop1\" aria-controls=\"drop1\" aria-expanded=\"false\" class=\"button round dropdown\">" . $current_user . "</button><br>
                          <ul id=\"drop1\" data-dropdown-content class=\"f-dropdown\" aria-hidden=\"true\">
                            <li><a href=\"editProfile.php\">Edit Profile</a></li>
                            <li><a href=\"changePassword.php\">Change Password</a></li>
                            <li><a href=\"cart.php\">My Cart</a></li>
                            <li><a href=\"history.php?id=" . $user_id . "\">My History</a></li>
                            <li><a href=\"logout.php\">Logout</a></li>
                          </ul>
                      </li>";
              }
          ?>
        </ul>
      </nav>
    </div>
    <br>

<!-- Left nav -->
  <div class="small-3 columns">
    <?php
      if ($_GET) {
        $product = getProduct($_GET['id']);
      }
      echo "<a class=\"th\" href=\"#\"><img style=\"height: 300px; width: 240px;\" src=\"img/" . $product['photo'] . "\"></a>";
    ?>
  </div>

<!-- Right nav -->
  <div style="margin-left: 0px;" class="small-4 columns">
    <?php
        echo "<b>Name: </b>" . $product['pName'] . "<br>";

        $select_cat_sql = "SELECT * FROM categories WHERE id = '" . $product['catId'] . "'";
    		$res = mysql_query($select_cat_sql);
        $cat = mysql_fetch_assoc($res);

        echo "<b>Category: </b>" . $cat['catName'] . "<br>";
        //echo $product['photo'] . "<br>";
        echo "<b>Price: </b>$" . $product['price'] . "<br>";
        echo "<b>Rating: </b>" . $product['rating'] . "<br>";
        echo "<b>Stock: </b>" . $product['stock'] . "<br>";
        echo "<b>Description: </b>" . $product['description'] . "<br>";

        if ($product['stock'] > 0) {
          echo "<a href=\"addToCart.php?id={$product['id']}\" class=\"button tiny alert\">Add to cart</a></li>";
        }
        else {
          echo "<a class=\"button tiny disabled\">Add to cart</a></li>";
        }
    ?>
  </div>

  <script>
    $(document).foundation();
  </script>

</body>
</html>
