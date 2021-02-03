<?php
  $showAlert = "false";
  $showError = "false";
  if($_SERVER['REQUEST_METHOD']=='POST'){
    include '_dbconnect.php';
    $username = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $conf_pass = $_POST['cpassword'];

    //check if user exists in db
    $exist_sql = "SELECT * FROM `users` WHERE user_email = '$username'";
    $result = mysqli_query($conn, $exist_sql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
      $showError = "emailerror";
      header("Location: /forum/index.php?signupsuccess=false&error=$showError");
    }
    else{
      if($pass == $conf_pass){
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`user_email`, `user_password`, `timestamp`) VALUES ( '$username' , '$hash' , current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
          $showAlert = "true";
          header("Location: /forum/index.php?signupsuccess=$showAlert");
          exit();
        }
      }
      else{
        $showError = "passerror";
        header("Location: /forum/index.php?signupsuccess=false&error=$showError");
      }
    }
  }
?>