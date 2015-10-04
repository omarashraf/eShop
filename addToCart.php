<?php
  session_start();

  // $action = isset($_GET['action']) ? $_GET['action'] : "";
  $id = isset($_GET['id']) ? $_GET['id'] : "";

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  // Check if the item is already in cart (implementation status: idle)

  array_push($_SESSION['cart'], $id);
  header('Location: productshome.php');
?>
