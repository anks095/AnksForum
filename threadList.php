<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Ank's PHP Forum</title>
</head>

<body>
    <?php include 'partial/_dbconnect.php'; ?>
    <?php include 'partial/_header.php'; ?>
    
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $categoryname = $row['category_name'];
        $categorydesc = $row['category_description'];
        $buttonstyleid = $row['category_id'];
    }
    ?>

    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            $user_sno = $_SESSION['sno'];
            // var_dump($user_sno);
            $method = $_SERVER['REQUEST_METHOD'];
            if($method=='POST'){
                //inserting data about threads into the db
                $threadtitle = $_POST['title'];
                $threaddesc = $_POST['desc'];

                //protection against XSS
                $threadtitle = str_replace(">","&gt" ,$threadtitle);
                $threadtitle = str_replace("<","&lt" ,$threadtitle);
                //protection against XSS
                $threaddesc = str_replace(">","&gt" ,$threaddesc);
                $threaddesc = str_replace("<","&lt" ,$threaddesc);

                $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$threadtitle', '$threaddesc', '$id', '$user_sno', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your thread has been posted,check in below for the thread.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                // else{

                // }
            }
        }
    ?>
    
    <!-- Category container start here -->
    <div class="container my-3">
        <div class="jumbotron bg-dark font-weight-bold" id="<?php echo "cat".$id; ?>">
            <h1 class="display-4">Welcome to <?php echo $categoryname; ?>-World</h1>
            <p class="lead"><?php echo $categorydesc; ?></p>
            <hr class="my-4">
            <p class="text-danger">This is a peer to peer forum.
                Forum Rules:
                No Spam / Advertising / Self-promote in the forums....
                Do not post copyright-infringing material....
                Do not post “offensive” posts, links or images....
                Do not cross post questions....
                Remain respectful of other members at all times.</p>
            <p class="lead">
            <button type="button" class="btn btn-sm btn-primary font-weight-bold" id="button<?php echo $buttonstyleid; ?>">Learn more</button>
            </p>
        </div>
    </div>
    <?php 
    $url=$_SERVER['REQUEST_URI'];
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
            <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h3>Create a <span class="badge" id="catbg'.$id.'">New Post</span></h3>
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action= "'.$url.'" method="post">
                        <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Post Title</label>
                        <input type="text" autocomplete="off" class="form-control" id="title" name="title" placeholder="title-text here" >
                        <label class="form-text text-muted">keep it short above</label>
                        </div>
                        <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Post description</label>
                        <textarea class="form-control" autocomplete="off" id="desc" name="desc" rows="3" placeholder="description here" ></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>';}
        else{
            echo '<div class="container">you need to log in to post threads here</div>';
        }
    ?>
    <div class="container mb-5">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $thread = $row['thread_title'];
            $threaddesc = $row['thread_description'];
            $time = $row['timestamp'];
            $styleid = $row['thread_cat_id'];
            $tid = $row['thread_id'];
            //getting the author name of the thread 
            $user = $row['thread_user_id'];
            $sql2 = "SELECT * FROM `users` WHERE sno=$user";
            $result2= mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            echo '<div class="media my-3">
                <img src="img/userdefault.png" width="34px" class="mr-3" alt="...">
                <div class="media-body">
                    <h5 class="mt-0"><a id="cat'.$styleid.'" href="thread.php?threadid='.$tid.'">'.$thread.'</a></h5>
                    <p>'.$threaddesc.'</p>
                    <p class="font-weight-bold">created on '. $time .', posted by '.$row2["user_email"].'</p>
                </div>
            </div>';
        }
        if($noResult){
            echo '<h3>No threads available. Be the First one to create <span class="badge" id="catbg'.$id.'">New thread</span></h3>';
        }
        ?>
    </div>

    <?php include 'partial/_footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>