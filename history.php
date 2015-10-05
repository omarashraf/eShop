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
    $id = isset($_GET['id']) ? $_GET['id'] : "";

    if ($id == 0) {
      // redirect to login page
      header('Location: login.php');
    }
    else {
      $history = getHistory($id);
      $i = 0;      
      while ($i < count($history)) {
        echo $history[$i] . "<br>";
        $i++;
      }
    }
  ?>

  <script>
    $(document).foundation();
  </script>
</body>
</html>
