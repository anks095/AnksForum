<?php 
include 'partial/_dbconnect.php';

session_start();
include 'partial/_loginModal.php';
include 'partial/_signupModal.php';

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forum">Ank\'s Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
            $sql = "SELECT category_name, category_id FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                  $categoryname = $row['category_name'];
                  $categoryid = $row['category_id'];
                  echo '<li><a class="dropdown-item" href="threadList.php?catid='.$categoryid.'">'.$categoryname.'</a></li>';}
              
      echo '</ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>';
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-success mx-2" type="submit">Search</button>
        <h6 class="text-light text-center my=0 mx-3 line-height-0">welcome '.$_SESSION['useremail'].'</h6>
        <button class="btn btn-outline-success mx-2"><a href="/forum/partial/_logout.php">Logout</a></button>
      </form>';
      }
      else{echo 
      '<div class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success mx-2" type="submit">Search</button>
        <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
      </div>';}
    echo 
    '</div>
  </div>
</nav>';
//echo $_SERVER['REQUEST_METHOD'];
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>You are signed-up successfully</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
else{
    if(isset($_GET['error'])){
      if($_GET['error'] == "emailerror"){
          echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>Email already exists</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
        if($_GET['error'] == "passerror"){
          echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>Passwords does not match</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        }
    }
}
if(isset($_GET['loggedin']) && $_GET['loggedin']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>successfully logged in</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
else{
  if(isset($_GET['error'])){
    if($_GET['error'] == "Password_or_username_error"){
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>Password or username error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    if($_GET['error'] == "user_does_not_exist"){
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>user does not exist</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
  }
}
if(isset($_GET['loggedout']) && $_GET['loggedout']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>successfully logged out</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>