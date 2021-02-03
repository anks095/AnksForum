<?php
  session_start();
//   echo "Logging out...wait...";
  session_unset();
  session_destroy();
  header("location: /forum/index.php?loggedout=true");
  exit();
?>