<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="mycss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>BLOG WORLD|HOME</title>

</head>


<body>
    <header>
        <nav class="navbar navbar-dark bg-primary mynav">
            <h3 class="heading">BLOG WORLD</h3>


        </nav>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background: white; margin-bottom: 50px;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add.php">Add a Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="posts.php">Personal Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <?php
    // Initialize the session
    session_start();

    // Check if the user is logged in, if not then redirect him to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: signin.php");
        exit;
    } else {
        $id = $_SESSION["username"];
    }
    ?>


    <div class="text-center">
        <h1>My Posts</h1>
    </div>
    <br>
    <div class="container-fluid">


        <?php

        $db = mysqli_connect("localhost", "root", "", "blogtest");


        $sql = "SELECT * FROM post where post_owner = '$id'";
        $result = $db->query($sql);



        ?>
        <?php   // LOOP TILL END OF DATA 

        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                $post = $rows['post_name'];
                $d = $rows['description'];
                $pid = $rows['id'];

                echo "
            
            <form class='mx-1 mx-md-4' method='POST' action='update.php'>      
                <div class='card mb-3' style='width: auto; display: block; margin-left:20px; margin-right:20px;' >
                    <div class='row g-0'>
                        <div class='col-md-4'>
                            <img src='data:image/jpeg;base64," . base64_encode($rows['image']) . "''class='img-fluid rounded-start' alt='No image found' style='height: auto; width: 100%; display:block; object-fit: cover;'>
                        </div>
                        <div class='col-md-8'>
                            <div class='card-body'>
                            <h5 class='card-title'>" . $rows['post_name'] . "</h5>
                                <p class='card-text'> " . $rows['description'] . "</p>
                                <p class='card-text'><small class='text-muted'>Published Date: " . $rows['created_date'] . "</small></p>
                                <p class='card-text'><small class='text-muted'>Publisher: " . $rows['post_owner'] . "</small></p>
                                <input type='hidden' name='postname' value='$post'>
                                <input type='hidden' name='description' value='$d'>
                                <input type='hidden' name='pid' value='$pid'>
                            </div>
      
                        </div>
                        <button type='submit' class='btn btn-primary btn-sm' style='width:15%; margin-left:10px; margin-bottom:10px; margin-top:10px'>Update</button>
                        </form>
                        <form method='POST' action='delete.php'><input type='hidden' name='pid' value='$pid'><button type='submit' class='btn btn-primary btn-sm' style='width:15%;  margin-left:10px; margin-bottom:10px;'>Delete</button></form>
    
                    </div>
                </div>
           ";
            }
            $db->close();
        } else
            echo "<div class='text-center'><h2>No posts have been published yet !!</h2></div>";
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>




</body>

</html>