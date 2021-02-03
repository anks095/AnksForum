<?php
    $showError="false";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include '_dbconnect.php';
        $email=$_POST['loginemail'];
        $password=$_POST['loginpassword'];

        $sql = "SELECT * FROM `users` WHERE user_email='$email'";
        $result = mysqli_query($conn, $sql);
        $numRow = mysqli_num_rows($result);
        if($numRow==1){
            $row=mysqli_fetch_assoc($result);
            if(password_verify($password, $row['user_password'])){
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['sno']=$row['sno'];
                $_SESSION['useremail']=$email;
                // echo "logged in". $email;
                header("Location: /forum/index.php?loggedin=true");
                exit();
            }
            else{
                $showError = "Password_or_username_error";
                header("Location: /forum/index.php?loggedin=false&error=$showError");
            }
        }
        else{
            $showError = "user_does_not_exist";
            header("Location: /forum/index.php?loggedin=false&error=$showError");
        }
    }
?>