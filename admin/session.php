<?php
session_start();
if(isset($_SESSION['slr_login'])) {

  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
  $user_profile_image = $_SESSION['user_profile_image'];
}
else {
  header("Location: index.php");
}