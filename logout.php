<?php
ob_start();
session_start();
// session_destroy();
if (isset($_SESSION['name_admin']) && isset($_SESSION['username_admin'])) {
  unset($_SESSION['username_admin']);
  unset($_SESSION['name_admin']);
  unset($_SESSION['id_admin']);
  header("location: login.php");
} else {
  header("location: login.php");
}
