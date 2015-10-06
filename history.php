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

  <title>History</title>
</head>
<body>

  <?php
    session_start();

    include('helper.php');
    if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin_password'])) {
      $user_id = $_SESSION['loggedin'];
    }
    else {
      header('Location: login.php');
    }
  ?>

  <!-- Nav bar -->
  <div class="contain-to-grid sticky">
    <nav style="color: white;" class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
      <ul class="inline-list" style="margin-top: 10px;">
        <li style="padding-right: 60px;"><a style="color: white;" href="#">eShop</a></li>
        <li style="padding-right: 20px;"><a href="#
          ">Home</a></li>
        <li style="padding-right: 20px;"><a href="productshome.php">Products</a></li>
        <li style="padding-right: 20px;"><a href="#">Profile</a></li>
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

    <div class="row">
      <h1>Products history</h1>
      <div class="small-12 small-centered columns">
        <table style="width: 100%;">
          <thead>
            <tr>
              <th>Name</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>

            <?php
              $id = isset($_GET['id']) ? $_GET['id'] : "";
              $history = getHistory($id);
              $total = 0;
              $i = 0;
              while ($i < sizeof($history['productId'])) {
                $product = getProduct($history['productId'][$i]);
                echo "<tr><td>" . $product['pName'] . "</td><td>$" . $product['price'] . "</td></tr>";
                $total += $product['price'];
                $i++;
              }
            ?>

          </tbody>
        </table>
        Total spent: $<?php echo $total; ?>
      </div>
    </div>

  <script>
    $(document).foundation();
  </script>
</body>
</html>
