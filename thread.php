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
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $question = $row['thread_title'];
        $description = $row['thread_description'];
        $user = $row['thread_user_id'];
        //var_dump($row['thread_user_id']);
        $buttonstyleid = $row['thread_cat_id'];
        $sql3 = "SELECT user_email FROM `users` WHERE sno=$user";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $posted_by = $row3['user_email'];
    }
    ?>
    <?php
        $method = $_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            //inserting data about comments into the db
            $content = $_POST['desc'];
            $content = str_replace(">","&gt" ,$content);
            $content = str_replace("<","&lt" ,$content);
            $sno = $_POST['sno'];
            $sql = "INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES (NULL, '$content', '$id', '$sno' , current_timestamp());";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your comment has been posted,check out the comments section.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            // else{

            // }
        }
    ?>
    <!-- Category container start here -->
    <div class="container my-3">
        <div class="jumbotron bg-light" id="cat<?php echo $buttonstyleid; ?>">
            <h1 class="display-4"><?php echo $question; ?></h1>
            <p class="lead text-dark"><?php echo $description; ?></p>
            <hr class="my-4">
            <p class="text-danger">This is a peer to peer forum.
                Forum Rules:
                No Spam / Advertising / Self-promote in the forums....
                Do not post copyright-infringing material....
                Do not post “offensive” posts, links or images....
                Do not cross post questions....
                Remain respectful of other members at all times.</p>
            <p class="lead">
                <?php 
                //$uname = $_SESSION['useremail'];
                echo '<button type="button" class="btn btn-sm btn-primary font-weight-bold" id="button'.$buttonstyleid.'" disabled>';
                echo 'Posted by ';
                echo '<a class="text-decoration-none" id="universal" href="#">'.$posted_by.'</a>';
                echo '</button>';
                ?>
                
            </p>
        </div>
    </div><?php
    $url=$_SERVER['REQUEST_URI'];
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<div class="container">
            <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h3>click here to expand to post <span class="badge" id="catbg'.$buttonstyleid.'">New comment</span></h3>
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action= "'.$url.'" method="post">
                        <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Post description</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="type here ..." ></textarea>
                        <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>';}
        else{
            echo '<div class="container">You need to log in to give comments</div>';
        }
    ?>
    <!-- iterating through comments -->
    <div class="container">
        <h1 class="py-2 mb-3">Discussions</h1>
        <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $comment = $row['comment_content'];
                $user_id = $row['comment_by']; //will be used when need to display image and name
                $time = $row['comment_time'];
                //$styleid = $row['thread_cat_id'];
                $tid = $row['thread_id'];
                $sql2 = "SELECT * FROM `users` WHERE sno=$user_id";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                if($row['comment_by']=='0'){
                    $user_nm = "Guest_User";
                }
                else{
                    $user_nm = $row2['user_email'];
                }
                echo '<div class="media my-3">
                    <img src="img/userdefault.png" width="34px" class="mr-3" alt="...">
                    <div class="media-body">
                        <p class="font-weight-bold my-0">'.$user_nm.'</p>
                        <p>'.$comment.'</p>
                        <p>commented on '. $time .'</p>
                    </div>
                </div>';
            }
            if($noResult){
                echo '<h3>No comments available. Be the First one to post <span class="badge" id="catbg'.$id.'">New thread</span></h3>';
            }
        ?>
    </div>

    <footer class="footer"><?php include 'partial/_footer.php'; ?></footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    
</body>

</html>