<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Ank's PHP Forum</title>
    <style>
        #maincontainer {
            min-height: 802px;
        }
    </style>
</head>

<body>
    <?php include 'partial/_dbconnect.php'; ?>
    <?php include 'partial/_header.php'; ?>

    <!-- search results starts here -->
    <div class="container my-3" id="maincontainer">
        <h1>Search result for <em>"
                <?php echo $_GET['search']; ?>"
            </em></h1>
        <?php
        //var_dump($_GET['search']);
        $noResult = true;
        $query = $_GET['search'];
        $sql = "SELECT * FROM `threads` WHERE MATCH(`thread_title`,`thread_description`) against ('$query')";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_description'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=". $thread_id;
            //search result
            echo '<div class="result">
                    <h3><a class="text-decoration-none" href="' . $url . '"><li>' . $title . '</li></a></h3>
                    <p>' . $desc . '</p>
                  </div>';
        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h3 class="display-4">No Result Found</h3>
                <p class="lead"><li>Make sure that all words are spelled correctly</li>
                <li>Try different keywords</li>
                <li>Try more general keywords</li></p>
            </div>
            </div>';
        }
    ?>
    </div>

    <?php include 'partial/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>