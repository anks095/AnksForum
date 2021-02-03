<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="style.css">
  <title>Ank's PHP Forum</title>
</head>

<body>
  <?php include 'partial/_header.php'; ?>
  <?php include 'partial/_dbconnect.php'; ?>

  <!-- slider start -->
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/slider1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/slider2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/slider3.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>

  <!-- Category container start here -->
  <div class="container my-3">
    <h2 class="text-center">Welcome to Ank's forum - Categories</h2>
    <div class="row my-4">
      
      <!-- Fetching all categories using loop through -->
      <?php
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn, $sql);
        $num1 = 1;
        while($row = mysqli_fetch_assoc($result)){
          $title=$row['category_name'];
          $desc=$row['category_description'];
          $id=$row['category_id']; 
          echo '<div class="col-md-4 my-2">
          <div class="card" style="width: 18rem;">
            <img src="img/card'.$num1.'.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><a class="text-decoration-none" href="threadList.php?catid='.$id.'">'.$title.'</a></h5>
              <p class="card-text">'. substr($desc, 0, 90).'.....'.'</p>
              <a href="threadList.php?catid='.$id.'" class="btn btn-primary">Explore Threads</a>
            </div>
          </div>
        </div>';
        $num1 += 1;
        }
      ?>
    </div>

  </div>

  <?php include 'partial/_footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->
</body>

</html>