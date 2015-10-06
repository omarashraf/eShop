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

  <title>Products</title>
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
        <li style="margin-top: -10px; float: right;">
        <!--<li style="padding-right: 20px;"><a href="#">Profile</a></li>-->
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
  <!-- Categories -->
  <div style="background: #f2f2f2;" class="small-3 columns">Categories
    <?php
      //include('helper.php');
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
    <!--<a href="#" style="border-radius: 25px;" class="button tiny success left inline">Search <i class="fi-magnifying-glass"></i></a>
    <div class="large-10 columns">
      <input style="border-radius: 25px; height: 33px;" type="text" />
    </div>-->

  <!--Login/register buttons-->
  <?php
      if(!isset($_SESSION['loggedin'])) {
          echo '<div style="float: right;">
                  <a href="login.php" class="button success">Login</a>
                  <a href="register.php" class="button">Register</a>
                </div>';
      }
  ?>


  <!-- Blocks -->
    <?php
      // include('helper.php');
      $array = array(
        'name' => array(),
        'price' => array(),
        'stock' => array(),
        'cat' => array(),
        'id' => array()
      );
      $array = products();

      $i = 0;
      echo '<ul class="small-block-grid-3">';
      while ($i < sizeof($array['name'])) {
        if ($_GET){
          if ($array['cat'][$i] == $_GET['cat']) {
            echo "<li>" . $array['name'][$i] . "<a class=\"th\" href=\"summary.php?id=" . $array['id'][$i] . "\"><img src=\"img/default-placeholder.png\"></a> $" . $array['price'][$i] . "<div style=\"float: right;\">";
            if ($array['stock'][$i] > 0) {
              echo "Stock: " . $array['stock'][$i] . "</div><br><a href=\"addToCart.php?id={$array['id'][$i]}\" class=\"button tiny alert\">Add to cart</a></li>";
            }
            else {
              echo "Stock: " . $array['stock'][$i] . "</div><br><a class=\"button tiny disabled\">Add to cart</a></li>";
            }
          }
          elseif ($_GET['cat'] == 0) {
            echo "<li>" . $array['name'][$i] . "<a class=\"th\" href=\"summary.php?id=" . $array['id'][$i] . "\"><img src=\"img/default-placeholder.png\"></a> $" . $array['price'][$i] . "<div style=\"float: right;\">";
            if ($array['stock'][$i] > 0) {
              echo "Stock: " . $array['stock'][$i] . "</div><br><a href=\"addToCart.php?id={$array['id'][$i]}\" class=\"button tiny alert\">Add to cart</a></li>";
            }
            else {
              echo "Stock: " . $array['stock'][$i] . "</div><br><a class=\"button tiny disabled\">Add to cart</a></li>";
            }
          }
        }
        else {
          echo "<li>" . $array['name'][$i] . "<a class=\"th\" href=\"summary.php?id=" . $array['id'][$i] . "\"><img src=\"img/default-placeholder.png\"></a> $" . $array['price'][$i] . "<div style=\"float: right;\">";
          if ($array['stock'][$i] > 0) {
            echo "Stock: " . $array['stock'][$i] . "</div><br><a href=\"addToCart.php?id={$array['id'][$i]}\" class=\"button tiny alert\">Add to cart</a></li>";
          }
          else {
            echo "Stock: " . $array['stock'][$i] . "</div><br><a class=\"button tiny disabled\">Add to cart</a></li>";
          }
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

  <script>
    $(document).foundation();
  </script>

</body>
</html>
